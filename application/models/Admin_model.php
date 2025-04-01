<?php

class Admin_model extends CI_Model
{
  public function get_certificate_by_number($certificate_number) {
    $this->db->select('id, certificate_number, student_name, mobile, institute_name, institute_place, course_name, course_duration, course_completion_date');
    $this->db->from('certificates');
    $this->db->where('certificate_number', $certificate_number);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array();  // Return the first matching certificate
    } else {
        return null;  // Return null if no certificate found
    }
}
}
