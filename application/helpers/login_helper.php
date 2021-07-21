<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('id')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $query = $ci->db->get_where('user_role', ['id' => $role_id])->row_array();
        $queryMenu = $query['menu'];

        if ($queryMenu != $menu) {
            redirect('auth/blocked');
        }
    }
}
