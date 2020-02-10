<?php

require_once("$CFG->libdir/formslib.php");

class newtest_form extends moodleform {

    public function definition() {
        global $DB;
        global $courseid, $blockid;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement("hidden", "courseid", $courseid);
        $mform->setType("courseid", PARAM_INT);
        $mform->addElement("hidden", "blockid", $blockid);
        $mform->setType("blockid", PARAM_INT);
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

        $mform->addElement('select', 'category', "Specify category", $list_categories);
        // textbox nr. questions
        $mform->addElement("text", "nr_all_questions", "Total questions (from {$nr_all_questions})");
        $mform->setType("nr_all_questions", PARAM_INT);
        $mform->addElement("text", "nr_binary_questions", "Binary questions");
        $mform->setType("nr_binary_questions", PARAM_INT);
        $mform->addElement("text", "nr_single_questions", "Single choice questions");
        $mform->setType("nr_single_questions", PARAM_INT);
        $mform->addElement("text", "nr_multiple_questions", "Multiple choice questions");
        $mform->setType("nr_multiple_questions", PARAM_INT);
        $mform->addElement("text", "nr_short_questions", "Short answer questions");
        $mform->setType("nr_short_questions", PARAM_INT);
        
        $this->add_action_buttons();
    }

    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }

}
