<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Breadcrumb
| Category:     Libraries
| Author:       Richard Davey
|               info@richarddavey.com
| Location:     http://github.com/richarddavey/codeigniter-breadcrumb/
| Copyright:    (c) 2011, Richard Davey
| Description:  Manages the breadcrumb object.
*/

class Breadcrumb {

    /**
     * Breadcrumbs stack
     */
    private $breadcrumbs = array();

    /**
     * Options
     */
    private $_tag_open = '<div class="breadcrumb">';
    private $_tag_close = '</div>';
    private $_crumb_open = '<div class="link">';
    private $_crumb_close = '</div>';
    private $_last_crumb_open = '<strong>';
    private $_last_crumb_close = '</strong>';
    private $_divider = ' &#8250; ';

    /**
     * Constructor
     *
     * @access    public
     *
     * @param    array    initialization parameters
     */
    public function __construct($params = array()) {
        if(count($params) > 0) {
            $this->initialize($params);
        }

        log_message('debug', 'Breadcrumb Class Initialized');
    }

    // -------------------------------------------------------------------

    /**
     * Initialize Preferences
     *
     * @access    public
     *
     * @param    array    initialization parameters
     *
     * @return    void
     */
    private function initialize($params = array()) {
        if(count($params) > 0) {
            foreach($params as $key => $val) {
                if(isset($this->{'_'.$key})) {
                    $this->{'_'.$key} = $val;
                }
            }
        }
    }

    // -------------------------------------------------------------------

    /**
     * Append crumb to stack
     *
     * @access    public
     *
     * @param    string $title
     * @param    string $href
     *
     * @return    void
     */
    function append_crumb($title, $href) {
        // no title or href provided
        if(!$title OR !$href) {
            return;
        }

        // add to end
        $this->breadcrumbs[] = array(
            'title' => $title,
            'href'  => $href
        );
    }

    // -------------------------------------------------------------------

    /**
     * Prepend crumb to stack
     *
     * @access    public
     *
     * @param    string $title
     * @param    string $href
     *
     * @return    void
     */
    function prepend_crumb($title, $href) {
        // no title or href provided
        if(!$title OR !$href) {
            return;
        }

        // add to start
        array_unshift($this->breadcrumbs, array(
            'title' => $title,
            'href'  => $href
        ));
    }

    // -------------------------------------------------------------------

    /**
     * Generate breadcrumb
     *
     * @access    public
     * @return    string
     */
    function output() {
        // breadcrumb found
        if($this->breadcrumbs) {
            // set output variable
            $output = $this->_tag_open;

            // add html to output
            foreach($this->breadcrumbs as $key => $crumb) {
                // add divider
                if($key) {
                    $output .= $this->_divider;
                }

                // if last element
                if(end(array_keys($this->breadcrumbs)) == $key) {
                    $output .= $this->_last_crumb_open.$crumb['title'].$this->_last_crumb_close;
                } else { // else add link and divider
                    $output .= $this->_crumb_open.'<a href="'.$crumb['href'].'">'.$crumb['title'].'</a>'.$this->_crumb_close;
                }
            }

            // return html
            return $output.$this->_tag_close.PHP_EOL;
        }

        // return blank string
        return '';
    }
}

/* End of file breadcrumb.php */
/* Location: ./application/libraries/breadcrumb.php */