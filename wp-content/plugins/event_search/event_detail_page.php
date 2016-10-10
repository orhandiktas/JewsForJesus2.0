<?php

$eventName = $_GET['eventname'];
$speakerName = $_GET['speakername'];
$dateTime = $_GET['datetime'];
$location = $_GET['location'];

if($eventname == "Christ in the Passover") {
	$description = $citp;
} elseif($eventname == "Christ in the Feast of Tabernacles") {
	$description = $citfot;
} elseif($eventname == "Hanukkah Message") {
	$description = $hm;
} elseif($eventname == "Gospel in the Feasts of Israel") {
	$description = $gitfoi;
} elseif($eventname == "How to Witness") {
	$description = $htw;
} elseif($eventname == "The Jewish Roots of Pentacost") {
	$description = $tjrop;
} elseif($eventname == "Jesus in the Old Testament") {
	$description = $jitot;
} elseif($eventname == "Multitudes") {
	$description = $multitides;
} elseif($eventname == "") {
	$description = "the default description";
}



// Christ in the Passover
$citp = "This sermonic demonstration uses visual aids to paint a picture of how Jesus fulfilled the Festival of Sukkot (also known as the Feast of Booths or Tabernacles). Our missionary will explain the traditional and Christological significance of this holiday. Jesus' claims to be the Light of the World and the Living Water are brought into perspective as the meaning of this holiday unfolds.";

// Christ in the Feast of Tabernacles
$citfot = "This sermonic demonstration uses visual aids to paint a picture of how Jesus fulfilled the Festival of Sukkot (also known as the Feast of Booths or Tabernacles). Our missionary will explain the traditional and Christological significance of this holiday. Jesus' claims to be the Light of the World and the Living Water are brought into perspective as the meaning of this holiday unfolds.";

// Hanukkah Message
$hm = "Birthed out of the tumultuous Inter-Testamental Period, Hanukkah is a key celebration in the Jewish tradition. For many Christians, this near-Christmas, Jewish holiday carries a darkness of ignorance. Allow Jews for Jesus the opportunity to shed some light on the Festival of Lights. Discover the roots of Hanukkah, its current significance to the Jewish people, and what believers can learn from it today. More than a simple historical lesson, this message is also a call to purity and stresses the importance of 'letting your light shine before men' (Matthew 5:16).";

// Gospel in the Feasts of Israel
$gitfoi = "The 'Gospel in the Feasts of Israel' message focuses on the seven chief Old Testament holidays or feasts. Our missionaries explain the purpose of these celebrations both then and now. They then show how the coming of Jesus fulfilled those feasts and gave them a larger meaning. This is an excellent teaching on the relationship of the Old and New Testaments. It also reveals the opportunities for Jewish evangelism throughout the year.";

// How to Witness - Jewish Evangelism Seminar
$htw = "We've found that if you can witness to a Jewish person you can witness to just about anybody! By hosting a 'How to Witness' program, your people can glean valuable tips on presenting the gospel to Jewish friends and 'not so Jewish' friends alike. These seminars provide insight into various objections to the gospel as well as conversation techniques, understanding Jewish sensitivities and more. Seminars are usually set up for a Saturday morning or for adult Bible classes, and are often given as a series.";

// The Jewish Roots of Pentacost
$tjrop = "Although part of the historical church calendar, most believers know little of the significance of Pentecost (also called the Feast of Weeks, or Shavuot). Allow Jews for Jesus to take your people through a Biblically based message on the historical importance of this Jewish celebration and its relevance to believers today. As the second of the three harvest feasts, Christians today will be strongly encouraged in this message focusing on the inclusion of both Jew and Gentile as part of God\'s people.";

// Jesus in the Old Testament
$jitot = "From Genesis to Malachi, explore how Jesus fulfilled Old Testament prophecy and look at what some of the first-century rabbis said about Messiah and his coming. More than an Old Testament lesson, the missionary will also share their first-hand experience of speaking about Messianic prophecy with Jewish people today. This message poses that if Jesus is the Messiah of the Old Testament, everyone should believe in Him including the Jewish people.";

// Multitudes
$multitides = "Multitudes presents a pictorial journey through the Messiah’s life and ministry featuring a collection of specially-commissioned paintings of scenes from the gospel of Matthew. Twenty-seven times in this most-Jewish of the gospels, we read of our Savior’s great compassion for the multitudes that followed Him, \"weary, scattered like sheep having no shepherd\" (Matthew 9:36). These were the multitudes that Jesus taught and healed, and for whom He would suffer and die. This sermonic presentation gives snapshots from Jesus's life and ministry, following His pilgrimage from Bethlehem to the empty tomb.";

?>