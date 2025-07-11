<?php

/**
 * Template Name: DEV - DEB Don't use in Production
 *
 *
 * @package TeleBruxelles
 */
get_header(); ?>
<?php
// initialisation de la session
$getID = curl_init();
curl_setopt($getID, CURLOPT_URL, "https://gestcom.divercom.be/mobile/bx1/77");
curl_setopt($getID, CURLOPT_RETURNTRANSFER, true);
$resultID = json_decode(curl_exec($getID));
curl_close($getID);
$pubId  =   $resultID->uniqId;
$getPub = curl_init();
curl_setopt($getPub, CURLOPT_URL, "https://gestcom.divercom.be/w/bx1/json");
curl_setopt($getPub, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($getPub, CURLOPT_POST, 1);
curl_error($getPub);
curl_setopt(
    $getPub,
    CURLOPT_POSTFIELDS,
    'lat:50.846812,lng:4.352360,db:true,page:77,url:"https://www.bx1.be/",title:"Accueil",type:"News",image:"' . get_stylesheet_directory_uri() . '/nophoto.png",uniqId:"' . $pubId . '",tags:""}'
);
curl_setopt($getPub, CURLOPT_RETURNTRANSFER, true);
$resultPub = curl_exec($getPub);
curl_close($getPub);
print_r($resultPub);
?>
<section class="news">
    Test publicité

    <h2 class="title">Increased visibility of the NCBR in Brussels in 2021 thanks to the new Office</h2>

    <p>The Brussels Office of the National Centre for Research and Development was established in 2020 in partnership with Business &amp; Science Poland but last year was the first one during which the Office operated at the full speed. Despite the difficult working conditions due to the ongoing pandemic restrictions, it was able to fulfil its statutory obligations and even more and present Polish R&amp;I environment in Brussels and, at the same time, share knowledge about European initiatives related to R&amp;I funding among Polish stakeholders.</p>

    Implementing Horizon Europe Programme

    <p>The Office continued its work to support the negotiation process of the Horizon Europe programme conducted by Ministry of Education and Science and the Permanent Representation of Poland to the EU. It also shared its knowledge in relation to the documents prepared by the EU Council working group on research and innovation.</p>
    <p>One of key responsibilities of the Office was supporting the coordination of Poland's participation in European partnerships under pillar II of HE. In addition, the Office initiated the NCBR's accession to the consortium applying for funds from Horizon Europe for the Coordination and Support Action project on the activities aimed at implementing the EU missions under the HE programme.</p>
    <p>Apart from the above, members of the Office’s team participated in the works of the strategic programme committee for HE and other configurations programme committees appointed to implement specific parts of HE.</p>

    Networking

    <p>Last year was also marked by important efforts to continue establishing and strengthening contacts between the Office and the European Commission and its executive agencies, as well as the European Parliament. Throughout the year the Office cooperated with the Office of the Polish Academy of Sciences, PolSCA in Brussels, regional offices in Brussels, the National Contact Point and the network of Regional Contact Points in Poland in order to exchange information and coordinate joint initiatives.</p>
    <p>The Office was also involved in the activities of R&amp;I organisations in Brussels. In agreement with the PolSCA Office, it participated in the meetings of IGLO network working groups, grouping Brussels R&amp;I offices from other European countries. Moreover, it led a fruitful cooperation with them resulting in co-organising several matchmaking events.</p>
    <p>Thanks to the engagement of the Office, the NCBR became a member of an important network operating in Brussels: Science Business and supported the NCBR Department of International Cooperation in joining TAFTIE. It resulted in, inter alia, increasing the possibilities of promoting the NCBR activities in the European arena.</p>

    Organisation of meetings and other events

    <p>Throughout year 2021 the Office organised 27 open webinars. They focued, inter alia, on main challenges of the new HE programme (for example strategic planning, open science and Gender Equality Plans) and the directions of EU research and innovation policy. They offered also a possibility to exchange good practices and search for project partners. Over 4,000 people took part in them.</p>
    <p>The Office continued to spread the news about missions in HE programme and organised a series of open webinars dedicated to individual missions. They gave the opportunity to discuss challenges faced by the missions with Polish experts in the Missions Boards and Assemblies as well as with possible future stakeholders. Another topic that was presented during open webinars were various Knowledge and Innovation Communities of the European Institute of Innovation and Technology.</p>
    <p>In the middle of the year, the Office launched "Brussels Talks" series – a regular monthly online meetings with high-level officials and representatives of the European R&amp;I community. It also organised four open matchmaking events (in the area of digital, mobility and transport, energy and culture sectors) for partners from Poland to meet with partners from other EU countries. Regular meetings were also held for regional offices in Brussels, for Regional Contact Points on Horizon Europe and with the Łukasiewicz Research Network Centre (17 in total). It also initiated first 2-week internship programme for Łukasiewicz.</p>
    <p>Due to the pandemic restrictions in Belgium, the Office organised only one official physical networking meeting which was an excellent opportunity to promote the Polish R&amp;I ecosystem with its research and innovation funding and performing organisations. It gathered over 80 people from Poland and from Brussels, including representatives of the NCBR, the National Science Centre, the National Agency for Academic Exchange, the Foundation for Polish Science, the Polish Academy of Sciences, the Łukasiewicz Research Network and the Permanent Representative of the Republic of Poland to the EU and officials of the European Commission as well as partner organisations from Brussels.</p>

    <p>The Brussels Office of the National Centre for Research and Development was established in 2020 in partnership with Business &amp; Science Poland but last year was the first one during which the Office operated at the full speed. Despite the difficult working conditions due to the ongoing pandemic restrictions, it was able to fulfil its statutory obligations and even more and present Polish R&amp;I environment in Brussels and, at the same time, share knowledge about European initiatives related to R&amp;I funding among Polish stakeholders.</p>

    Implementing Horizon Europe Programme

    <p>The Office continued its work to support the negotiation process of the Horizon Europe programme conducted by Ministry of Education and Science and the Permanent Representation of Poland to the EU. It also shared its knowledge in relation to the documents prepared by the EU Council working group on research and innovation.</p>
    <p>One of key responsibilities of the Office was supporting the coordination of Poland's participation in European partnerships under pillar II of HE. In addition, the Office initiated the NCBR's accession to the consortium applying for funds from Horizon Europe for the Coordination and Support Action project on the activities aimed at implementing the EU missions under the HE programme.</p>
    <p>Apart from the above, members of the Office’s team participated in the works of the strategic programme committee for HE and other configurations programme committees appointed to implement specific parts of HE.</p>

    Networking

    <p>Last year was also marked by important efforts to continue establishing and strengthening contacts between the Office and the European Commission and its executive agencies, as well as the European Parliament. Throughout the year the Office cooperated with the Office of the Polish Academy of Sciences, PolSCA in Brussels, regional offices in Brussels, the National Contact Point and the network of Regional Contact Points in Poland in order to exchange information and coordinate joint initiatives.</p>
    <p>The Office was also involved in the activities of R&amp;I organisations in Brussels. In agreement with the PolSCA Office, it participated in the meetings of IGLO network working groups, grouping Brussels R&amp;I offices from other European countries. Moreover, it led a fruitful cooperation with them resulting in co-organising several matchmaking events.</p>
    <p>Thanks to the engagement of the Office, the NCBR became a member of an important network operating in Brussels: Science Business and supported the NCBR Department of International Cooperation in joining TAFTIE. It resulted in, inter alia, increasing the possibilities of promoting the NCBR activities in the European arena.</p>

    Organisation of meetings and other events

    <p>Throughout year 2021 the Office organised 27 open webinars. They focued, inter alia, on main challenges of the new HE programme (for example strategic planning, open science and Gender Equality Plans) and the directions of EU research and innovation policy. They offered also a possibility to exchange good practices and search for project partners. Over 4,000 people took part in them.</p>
    <p>The Office continued to spread the news about missions in HE programme and organised a series of open webinars dedicated to individual missions. They gave the opportunity to discuss challenges faced by the missions with Polish experts in the Missions Boards and Assemblies as well as with possible future stakeholders. Another topic that was presented during open webinars were various Knowledge and Innovation Communities of the European Institute of Innovation and Technology.</p>
    <p>In the middle of the year, the Office launched "Brussels Talks" series – a regular monthly online meetings with high-level officials and representatives of the European R&amp;I community. It also organised four open matchmaking events (in the area of digital, mobility and transport, energy and culture sectors) for partners from Poland to meet with partners from other EU countries. Regular meetings were also held for regional offices in Brussels, for Regional Contact Points on Horizon Europe and with the Łukasiewicz Research Network Centre (17 in total). It also initiated first 2-week internship programme for Łukasiewicz.</p>
    <p>Due to the pandemic restrictions in Belgium, the Office organised only one official physical networking meeting which was an excellent opportunity to promote the Polish R&amp;I ecosystem with its research and innovation funding and performing organisations. It gathered over 80 people from Poland and from Brussels, including representatives of the NCBR, the National Science Centre, the National Agency for Academic Exchange, the Foundation for Polish Science, the Polish Academy of Sciences, the Łukasiewicz Research Network and the Permanent Representative of the Republic of Poland to the EU and officials of the European Commission as well as partner organisations from Brussels.</p>


</section>
<?php get_footer(); ?>