<?php

require_once("$CFG->libdir/formslib.php");

class newtest_form extends moodleform {

    public function definition() {
        global $DB;
        global $courseid;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('header', 'configheader', 'Common options');
        // test name
        $mform->addElement('text', 'pagetitle', "Test Name"); //get_string('pagetitle', 'block_simplehtml'));
        $mform->setType('pagetitle', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('pagetitle', "New test");        //Default value
        // combobox question categories
        $list_categories = [];

        $coursecontext = context_course::instance($courseid);

        $categories = $DB->get_records("question_categories", ["contextid" => $coursecontext->id]);

        foreach ($categories as $category) {
            if ($category->name !== 'top') {
                $list_categories[$category->id] = $category->name;
            }
        }

        $mform->addElement('select', 'type', "Specify category", $list_categories);

        // textbox nr. questions
        
        $this->add_action_buttons();
    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }

}
