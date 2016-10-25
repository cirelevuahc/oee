<?php
/**
 * Class name : SvgIcon.
 *
 * @Author : Eric chauvel
 * @Date : 11/2015
 */

class SvgIcon {

    private $svg;

    /**
     * Display svg file.
     *
     * @param string $image  Image path
     * @param string/boolean $id  Image id, if id is given take it, if not take id from file.
     * @param string/boolean $class  Image class, if class is given take it, if not take class from file.
     * @param boolean $count  If true add count to id.
     * @param boolean $display  If true display svg, if not return svg
     *
     * @return string
     */
    public function display( $image, $id = false, $class = false, $count = false, $display = true ) {
        $this->svg = $this->open( $image );

        if ( $this->svg === false ) {
            $message['type']    = 'erreur';
            $message['content'] =   'image not found';
        }

        $this->svg = $this->extract_svg( $this->svg );

        if ( $id != false ) {
            if ( $count ) $id = $id . '-' . $count;
        } else {
            if ( $count ) $id = $this->attr('id') . '-' . $count;
        }

        $this->attr('id', $id );

        if ( $class != false ) $this->attr( 'class', $class );

        if ( $display )
            echo( $this->svg );
        else
            return $this->svg;
    }

    /**
     * Get or Set attribut value
     *
     * @param string $attr
     * @param string $value
     *
     * @return string $value If set
     */
    private function attr( $attr, $value = null ) {
        $pos_start = strpos( $this->svg, $attr ) + strlen( $attr ) + 2;
        $pos_end = strpos( $this->svg, '"', $pos_start );
        $lenght = $pos_end - $pos_start;
        $actual_value = substr( $this->svg, $pos_start, $lenght );

        if ( $value == null ) {
            return $actual_value;
        } else { 
            if ( $lenght == 0 ) {
                $this->svg = str_replace( $attr . '=""', $attr . '="' . $value . '"', $this->svg );
            } else {
                $this->svg = str_replace( $actual_value, $value, $this->svg );
            }

        }
    }



    /**
     * Open svg file.
     */
    private function open( $file_name ) {
       $file = file_get_contents( $file_name );

       return $file;
    }

    /**
     * Keep only svg tag.
     */
    private function extract_svg( $svg ) {
        $tag_start = '<svg';
        $tag_end = '</svg>';

        $pos_start = strpos( $svg, $tag_start );
        $pos_end = strpos( $svg, $tag_end, $pos_start ) + 1;
        $lenght = $pos_end - $pos_start + strlen( $tag_end );

        $new_svg = substr( $svg, $pos_start, $lenght );

        return $new_svg;
    }

}

?>