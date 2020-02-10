<?php

require('../../config.php');
require_once 'newtest_form.php';

global $DB;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);
$id = optional_param('id', 0, PARAM_INT);

if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_tester', $courseid);
}

require_login();

$context = context_course::instance($courseid);
$PAGE->set_context($context);

$PAGE->set_url('/blocks/tester/newtest.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('newtest', 'block_tester'));

echo $OUTPUT->header();

$settingsnode = $PAGE->settingsnav->add(get_string('testersettings', 'block_tester'));
$editurl = new moodle_url('/blocks/tester/newtest.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_tester'), $editurl);
$editnode->make_active();

$mform = new newtest_form();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    redirect(new moodle_url('/course/view.php', array('id' => $courseid))); 
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.
    //Set default data (if any)
    //$mform->set_data($toform);

    //displays the form
    $mform->display();
}

echo $OUTPUT->footer();
