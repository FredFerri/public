<?php

$xw = xmlwriter_open_memory();
xmlwriter_set_indent($xw, 1);
$res = xmlwriter_set_indent_string($xw, ' ');

xmlwriter_start_document($xw, '1.0', 'UTF-8');

// Un premier élément
xmlwriter_start_element($xw, 'rss');

// Attribut 'att1' pour élément 'tag1'
xmlwriter_start_attribute($xw, 'version');
xmlwriter_text($xw, '2.0');
xmlwriter_end_attribute($xw);

xmlwriter_write_comment($xw, 'ceci est un commentaire.');

// Début d'un élément enfant
xmlwriter_start_element($xw, 'channel');

// ELEMENT : Title
xmlwriter_start_element($xw, 'title');
xmlwriter_text($xw, 'BX1 Agenda.brussels, Visit.brussels RSS XML');
xmlwriter_end_element($xw);

// ELEMENT : Link
xmlwriter_start_element($xw, 'link');
xmlwriter_text($xw, "https://". $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
xmlwriter_end_element($xw); // title

// ELEMENT : Description
xmlwriter_start_element($xw, 'description');
xmlwriter_text($xw, "Flux RSS destiné à l'affichage des vidéos des émissions LCR, L'invité culture TPA et Mont des arts.");
xmlwriter_end_element($xw); // title

// ELEMENT : Language
xmlwriter_start_element($xw, 'language');
xmlwriter_text($xw, 'fr');
xmlwriter_end_element($xw); // title

xmlwriter_end_element($xw); // channel
xmlwriter_end_element($xw); // channel


// CDATA
//xmlwriter_start_element($xw, 'testc');
//xmlwriter_write_cdata($xw, "Ceci est du contenu cdata");
//xmlwriter_end_element($xw); // testc
//
//xmlwriter_start_element($xw, 'testc');
//xmlwriter_start_cdata($xw);
//xmlwriter_text($xw, "test cdata2");
//xmlwriter_end_cdata($xw);
//xmlwriter_end_element($xw); // testc

xmlwriter_end_document($xw);

echo xmlwriter_output_memory($xw);