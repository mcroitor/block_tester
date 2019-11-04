<?php

class block_tester extends block_base {

    public function init() {
        $this->title = get_string('tester', 'block_tester');
    }

    public function get_content() {
        global $COURSE;
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $url = new moodle_url('/blocks/tester/newtest.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
        $this->content->text = html_writer::link($url, get_string('newtest', 'block_tester'));
        $this->content->footer = "";

        return $this->content;
    }

    public function applicable_formats() {
        return ["course-view" => true];
    }

}
