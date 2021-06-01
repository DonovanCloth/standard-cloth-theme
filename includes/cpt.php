<?php

function create_post_type_clotheme()
{
  $labels = array(
    'name' => __('Cases', 'clotheme'), // Rename these to suit
    'singular_name' => __('Case', 'clotheme'),
    'add_new' => __('Hinzufügen', 'clotheme'),
    'add_new_item' => __('Hinzufügen', 'clotheme'),
    'edit' => __('Bearbeiten', 'clotheme'),
    'edit_item' => __('Bearbeiten', 'clotheme'),
    'new_item' => __('Neu', 'clotheme'),
    'view' => __('Ansehen', 'clotheme'),
    'view_item' => __('Ansehen', 'clotheme'),
    'search_items' => __('Suchen', 'clotheme'),
    'not_found' => __('Keine Cases gefunden', 'clotheme'),
    'not_found_in_trash' => __(
      'Keine Cases im Papierkorb',
      'clotheme'
    ),

  );
  $args = array(
    'labels'             => $labels,
    'description'        => 'Recipe custom post type.',
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'recipe'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 20,
    'supports'           => array('title', 'editor', 'author', 'thumbnail'),
    'taxonomies'         => array('category', 'post_tag'),
    'show_in_rest'       => true
  );

  //register_post_type( 'Recipe', $args );
}





// add_action( 'init', 'create_leistung_taxonomy', 0 );
// function create_leistung_taxonomy() {
 
//   $labels = array(
//     'name' => _x( 'Kategorie', 'taxonomy general name' ),
//     'singular_name' => _x( 'Kategorie', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Suche' ),
//     'all_items' => __( 'Alle' ),
//     'parent_item' => __( 'Eltern' ),
//     'parent_item_colon' => __( 'Eltern:' ),
//     'edit_item' => __( 'Bearbeiten' ), 
//     'update_item' => __( 'Aktualisieren' ),
//     'add_new_item' => __( 'Hinzufügen' ),
//     'new_item_name' => __( 'Name' ),
//     'menu_name' => __( 'Kategorien' ),
//   );    

//   register_taxonomy('kategorie',array('leistung'), array(
//     'hierarchical' => true,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'leistung' ),
//   ));
 
// }
