<?php

    $to = 'bitantepd23@uww.edu,curringtpm17@uww.edu';
    $subject = "Millennium Falcon";

    $organizer          = 'Darth Vader';
    $organizer_email    = 'darthvader@arturito.net';

    $participant_name_1 = 'Boushh';
    $participant_email_1= 'bitantepd23@uww.edu';

    $participant_name_2 = 'Boba Fett';
    $participant_email_2= 'curringtpm17@uww.edu';

    $location           = "Stardestroyer-013";
    $date               = '20131026';
    $startTime          = '0800';
    $endTime            = '0900';
    $subject            = 'Millennium Falcon';
    $desc               = 'The purpose of the meeting is to discuss the capture of Millennium Falcon and its crew.';

    $headers = 'Content-Type:text/calendar; Content-Disposition: inline; charset=utf-8;\r\n';
    $headers .= "Content-Type: text/plain;charset=\"utf-8\"\r\n"; #EDIT: TYPO

    $message = "
    BEGIN:VCALENDAR\r\n
    VERSION:2.0\r\n
    PRODID:-//hacksw/handcal//NONSGML v1.0//EN\r\n
    CALSCALE:GREGORIAN\r\n
    BEGIN:VEVENT\r\n
    LOCATION:123 Main St, Whitewater, WI\r\n
    DESCRIPTION:This is the description\r\n
    DTSTART:2018-5-7 3:00PM\r\n
    DTEND:2018-5-7 3:30PM\r\n
    SUMMARY:This is a the summary\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_1.";X-NUM-GUESTS=0:MAILTO:".$participant_email_1."\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_2.";X-NUM-GUESTS=0:MAILTO:".$participant_email_2."\r\n
    END:VEVENT\r\n
    END:VCALENDAR\r\n";



    //switched PRODID AND VERSION
    //Updated PRODID TO -//Microsoft Corporation//Outlook 16.0 MIMEDIR//EN
  /*  $message = "BEGIN:VCALENDAR\r\n
    PRODID:-//Microsoft Corporation//Outlook 16.0 MIMEDIR//EN\r\n
    VERSION:2.0\r\n
    METHOD:Publish\r\n
    X-CALSTART:20170305T210000Z\r\n
    X-CALSTART:20170305T000000\r\n
    X-CALEND:20180502T133000Z\r\n
    X-WR-RELCALID:{0000003A-FE60-D1FA-FDDE-8D4BB11F7FC0}\r\n
    X-WR-CALNAME:Home\r\n
    BEGIN:VTIMEZONE\r\n
    TZID:Central Standard Time\r\n
    BEGIN:STANDARD\r\n
    UID:" . md5(uniqid(mt_rand(), true)) . "example.com\r\n
    DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z\r\n
    DTSTART:".$date."T".$startTime."00Z\r\n
    DTEND:".$date."T".$endTime."\r\n
    SUMMARY:".$subject."\r\n
    ORGANIZER;CN=".$organizer.":mailto:".$organizer_email."\r\n
    LOCATION:".$location."\r\n
    DESCRIPTION:".$desc."\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_1.";X-NUM-GUESTS=0:MAILTO:".$participant_email_1."\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_2.";X-NUM-GUESTS=0:MAILTO:".$participant_email_2."\r\n
    END:VEVENT\r\n
    END:VCALENDAR\r\n";
*/
    $headers .= $message;
    mail($to, $subject, $message, $headers);
?>
