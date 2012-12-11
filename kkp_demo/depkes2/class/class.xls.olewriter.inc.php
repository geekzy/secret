<?php
/*
*  Module written/ported by Xavier Noguer <xnoguer@rezebra.com>
*
*  This is the copyright notice from the PERL Spreadsheet::WriteExcel module:
*
*  © MM-MMII, John McNamara.
*
*  All Rights Reserved. This module is free software. It may be used,
*  redistributed and/or modified under the same terms as Perl itself.
*
*  The majority of this is _NOT_ my code.  I simply ported it from the
*  PERL Spreadsheet::WriteExcel module.
*
*  The author of the Spreadsheet::WriteExcel module is John McNamara
*  <jmcnamara@cpan.org>
*
*  I _DO_ maintain this code, and John McNamara has nothing to do with the
*  porting of this code to PHP.  Any questions directly related to this
*  class library should be directed to me.
*
*  License Information:
*
*    Spreadsheet::WriteExcel:  A library for generating Excel Spreadsheets
*    Copyright (C) 2002 Xavier Noguer xnoguer@rezebra.com
*
*    This library is free software; you can redistribute it and/or
*    modify it under the terms of the GNU Lesser General Public
*    License as published by the Free Software Foundation; either
*    version 2.1 of the License, or (at your option) any later version.
*
*    This library is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
*    Lesser General Public License for more details.
*
*    You should have received a copy of the GNU Lesser General Public
*    License along with this library; if not, write to the Free Software
*    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
* Class for generating Excel Spreadsheets
*
* @autor Xavier Noguer <xnoguer@rezebra.com>
*/
class OLEwriter
{
    /**
    * Class for creating an OLEwriter
    */
    function OLEwriter()
    {
        $filehandle    = "";
        $fileclosed    = 0;
        $internal_fh   = 0;
        $biff_only     = 0;
        $size_allowed  = 0;
        $biffsize      = 0;
        $booksize      = 0;
        $big_blocks    = 0;
        $list_blocks   = 0;
        $root_start    = 0;
        $block_count   = 4;
        //$this->initialize();
    }


###############################################################################
#
# _initialize()
#
# Check for a valid filename and store the filehandle.
# Filehandle "-" writes to STDOUT
#
/*sub _initialize {

    my $this    = shift;
    my $OLEfile = $this->{_OLEfilename};
    my $fh;

    # Check for a filename. Workbook.pm will catch this first.
    if ($OLEfile eq '') {
        croak('Filename required by Spreadsheet::WriteExcel->new()');
    }

    # If the filename is a reference it is assumed that it is a valid
    # filehandle, if not we create a filehandle.
    #
    if (ref($OLEfile)) {
        $fh = $OLEfile;
    }
    else{
        # Create a new file, open for writing
        $fh = FileHandle->new("> $OLEfile");
        # Workbook.pm also checks this but something may have happened since
        # then.
        if (not defined $fh) {
            croak "Can't open $OLEfile. It may be in use or protected.\n";
        }

        # binmode file whether platform requires it or not
        binmode($fh);

        $this->{_internal_fh} = 1;
    }

    # Store filehandle
    $this->{_filehandle} = $fh;
}*/


    /**
    * Set the size of the data to be written to the OLE stream.
    * The maximun size comes from this:
    *   $big_blocks = (109 depot block x (128 -1 marker word)
    *                 - (1 x end words)) = 13842
    *   $maxsize    = $big_blocks * 512 bytes = 7087104
    *
    */
    function set_size($biffsize)
    {
        $maxsize = 7087104; // TODO: extend max size
 
        if ($biffsize > $maxsize) {
            # croak() won't work here if close() called via DESTROY
            /*print STDERR "Maximum file size, $maxsize, exceeded. To create files ".
                         "bigger than this limit please refer to the "            .
                         "Spreadsheet::WriteExcel::Big documentation.\n";

            return $this->{_size_allowed} = 0; # TODO Fix this for DESTROY*/
            die("error!!!");
            }

        $this->biffsize = $biffsize;
        // Set the min file size to 4k to avoid having to use small blocks
        if ($biffsize > 4096)
        {
            $this->booksize = $biffsize;
        }
        else
        {
            $this->booksize = 4096;
        }
        $this->size_allowed = 1;
        return(1);
    }


    /**
    * Calculate various sizes needed for the OLE stream
    */
    function calculate_sizes()
    {
        $datasize = $this->booksize;
        if ($datasize % 512 == 0)
        {
            $this->big_blocks = $datasize/512;
        }
        else
        {
            $this->big_blocks = (int)($datasize/512) + 1;
        }
        // There are 127 list blocks and 1 marker blocks for each big block
        // depot + 1 end of chain block
        $this->list_blocks = (int)(($this->big_blocks)/127) + 1;
        $this->root_start  = $this->big_blocks;
    }


###############################################################################
#
# close()
#
# Write root entry, big block list and close the filehandle.
# This routine is used to explicitly close the open filehandle without
# having to wait for DESTROY.
#
  function close() 
    {
    //return if not $this->{_size_allowed};
    $this->write_padding();          //if not $this->{_biff_only};
    $this->write_property_storage(); //if not $this->{_biff_only};
    $this->write_big_block_depot();  //if not $this->{_biff_only};
    # Close the filehandle if it was created internally.
    //CORE::close($this->{_filehandle}) if $this->internal_fh;
    // $this->{_fileclosed} = 1;
    }


###############################################################################
#
# DESTROY()
#
# Close the filehandle if it hasn't already been explicitly closed.
#
/*sub DESTROY {

    my $this = shift;
    if (not $this->{_fileclosed}) { $this->close() }
}*/


    /**
    * Write BIFF data to OLE file.
    *
    * @param string $data string of bytes to be written
    */
    function write($data) //por ahora sólo a STDOUT
    {
        print($data);
    }


    /**
    * Write OLE header block.
    */
    function write_header()
    {
        $this->calculate_sizes();
        $root_start      = $this->root_start;
        $num_lists       = $this->list_blocks;
        $id              = pack("NN",   0xD0CF11E0, 0xA1B11AE1);
        $unknown1        = pack("VVVV", 0x00, 0x00, 0x00, 0x00);
        $unknown2        = pack("vv",   0x3E, 0x03);
        $unknown3        = pack("v",    -2);
        $unknown4        = pack("v",    0x09);
        $unknown5        = pack("VVV",  0x06, 0x00, 0x00);
        $num_bbd_blocks  = pack("V",    $num_lists);
        $root_startblock = pack("V",    $root_start);
        $unknown6        = pack("VV",   0x00, 0x1000);
        $sbd_startblock  = pack("V",    -2);
        $unknown7        = pack("VVV",  0x00, -2 ,0x00);
        $unused          = pack("V",    -1);

        print($id);
        print($unknown1);
        print($unknown2);
        print($unknown3);
        print($unknown4);
        print($unknown5);
        print($num_bbd_blocks);
        print($root_startblock);
        print($unknown6);
        print($sbd_startblock);
        print($unknown7);

        for($i=1; $i <= $num_lists; $i++)
        {
            $root_start++;
            print(pack("V",$root_start));
        }
        for($i = $num_lists; $i <=108; $i++)
        {
            print($unused);
        }
    }


    /**
    * Write big block depot.
    */
    function write_big_block_depot()
    {
        $num_blocks   = $this->big_blocks;
        $num_lists    = $this->list_blocks;
        $total_blocks = $num_lists *128;
        $used_blocks  = $num_blocks + $num_lists +2;

        $marker       = pack("V", -3);
        $end_of_chain = pack("V", -2);
        $unused       = pack("V", -1);

        for($i=1; $i < $num_blocks; $i++)
        {
            print(pack("V",$i));
        }
        print($end_of_chain);
        print($end_of_chain);
        for($i=0; $i < $num_lists; $i++)
        {
            print($marker);
        }
        for($i=$used_blocks; $i <= $total_blocks; $i++)
        {
            print($unused);
        }
    }

    /**
    * Write property storage. TODO: add summary sheets
    */
    function write_property_storage()
    {
        $rootsize = -2;
        $booksize = $this->booksize;
        /***************  name         type   dir start size */
        $this->write_pps("Root Entry", 0x05,   1,   -2, 0x00);
        $this->write_pps("Book",       0x02,  -1, 0x00, $booksize);
        $this->write_pps('',           0x00,  -1, 0x00, 0x0000);
        $this->write_pps('',           0x00,  -1, 0x00, 0x0000);
    }


###############################################################################
#
# _write_pps()
#
# Write property sheet in property storage
#
  function write_pps($name,$type,$dir,$start,$size)
    {
    $length          = 0;
    $rawname = '';

    /*if ($name ne '') {
        $name   = $_[0] . "\0";
        # Simulate a Unicode string
        @name   = map(ord, split('', $name));
        $length = length($name) * 2;
    }

    my $rawname         = pack("v*", @name);*/

    if ($name != '') {
        $name   = $name . "\0";
        for($i=0;$i<strlen($name);$i++)
          {
          // Simulate a Unicode string
          $rawname .= pack("H*",dechex(ord($name{$i}))).pack("C",0);
          }
        $length = strlen($name) * 2;
        }

    $zero            = pack("C",  0);
    $pps_sizeofname  = pack("v",  $length);    #0x40
    $pps_type        = pack("v",  $type);      #0x42
    $pps_prev        = pack("V",  -1);         #0x44
    $pps_next        = pack("V",  -1);         #0x48
    $pps_dir         = pack("V",  $dir);       #0x4c

    $unknown1        = pack("V",  0);

    $pps_ts1s        = pack("V",  0);          #0x64
    $pps_ts1d        = pack("V",  0);          #0x68
    $pps_ts2s        = pack("V",  0);          #0x6c
    $pps_ts2d        = pack("V",  0);          #0x70
    $pps_sb          = pack("V",  $start);      #0x74
    $pps_size        = pack("V",  $size);      #0x78


    print($rawname);
    for($i=0; $i < (64 -$length); $i++)
        print($zero);
    print($pps_sizeofname);
    print($pps_type);
    print($pps_prev);
    print($pps_next);
    print($pps_dir);
    for($i=0; $i < 5; $i++)
        print($unknown1);
    print($pps_ts1s);
    print($pps_ts1d);
    print($pps_ts2d);
    print($pps_ts2d);
    print($pps_sb);
    print($pps_size);
    print($unknown1);
    }

    /**
    * Pad the end of the file
    */
    function write_padding()
    {
        $biffsize = $this->biffsize;
        if ($biffsize < 4096)
        {
        $min_size = 4096;
        }
    else
        {    
            $min_size = 512;
        }
    if ($biffsize % $min_size != 0)
        {
            $padding  = $min_size - ($biffsize % $min_size);
            for($i=0; $i < $padding; $i++)
                print("\0");
        }
    }
}
?>