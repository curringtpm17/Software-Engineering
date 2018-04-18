<?php
session_start();
include "../LookupTables/BuildingLookup.php";
include_once "InputTesting.php";
// Variables used in this script:
$summary = "A Test ICS File";  //- text title of the event
$datestart = "8:00pm";  //- the starting date (in seconds since unix epoch)
$dateend = "9:00pm";  //- the ending date (in seconds since unix epoch)
$reldate = $_SESSION["ShowThisDay"];  //- the relative date
$address = "Home";  //- the event's address
$uri = "";  //- the URL of the event (add http://)
$description = "I would really like it if this worked"; //- text description of the event
$filename = "WarhawkWheels.ics";   //- the name of this file for saving (e.g. my-event-name.ics)
if ($reldate == date("l")) {
    $reldate = "Today";
} else {
    $reldate = "Next " . $reldate;
}
//
// Notes:
//  - the UID should be unique to the event, so in this case I'm just using
//    uniqid to create a uid, but you could do whatever you'd like.
//
//  - iCal requires a date format of "yyyymmddThhiissZ". The "T" and "Z"
//    characters are not placeholders, just plain ol' characters. The "T"
//    character acts as a delimeter between the date (yyyymmdd) and the time
//    (hhiiss), and the "Z" states that the date is in UTC time. Note that if
//    you don't want to use UTC time, you must prepend your date-time values
//    with a TZID property. See RFC 5545 section 3.3.5
//
//  - The Content-Disposition: attachment; header tells the browser to save/open
//    the file. The filename param sets the name of the file, so you could set
//    it as "my-event-name.ics" or something similar.
//
//  - Read up on RFC 5545, the iCalendar specification. There is a lot of helpful
//    info in there, such as formatting rules. There are also many more options
//    to set, including alarms, invitees, busy status, etc.
//
//      https://www.ietf.org/rfc/rfc5545.txt
// 1. Set the correct headers for this file
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// 2. Define helper functions
// Converts a unix timestamp to an ics-friendly format
// NOTE: "Z" means that this timestamp is a UTC timestamp. If you need
// to set a locale, remove the "\Z" and modify DTEND, DTSTAMP and DTSTART
// with TZID properties (see RFC 5545 section 3.3.5 for info)
//
// Also note that we are using "H" instead of "g" because iCalendar's Time format
// requires 24-hour time (see RFC 5545 section 3.3.12 for info).
function dateToCal($timestamp) {
    return date('Ymd\THis', $timestamp);
}

function relDateToCal($day, $time) {
    $strtime = strtotime($time);
    $timestamp = dateToCal($strtime);
    $strdate = strtotime($day);
    $datestamp = dateToCal($strdate);
    $datetimestamp = strstr($datestamp, "T", true) . strstr($timestamp, "T", false);
    return $datetimestamp;
}
function endTime ($starttime){
$starttimehour = strstr($starttime, ":", true);
$starttimeminute = substr(strstr($starttime, ":"),1);
$endtime = date("H:i", mktime($starttimehour, ($starttimeminute + 20)));
return $endtime;
}
// Escapes a string of characters
function escapeString($string) {
    return preg_replace('/([\,;])/', '\\\$1', $string);
}

// 3. Echo out the ics file's contents
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
BEGIN:VTIMEZONE
TZID:America/Chicago
X-LIC-LOCATION:America/Chicago
BEGIN:DAYLIGHT
TZOFFSETFROM:-0600
TZOFFSETTO:-0500
TZNAME:CDT
DTSTART:19700308T020000
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=2SU
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:-0500
TZOFFSETTO:-0600
TZNAME:CST
DTSTART:19701101T020000
RRULE:FREQ=YEARLY;BYMONTH=11;BYDAY=1SU
END:STANDARD
END:VTIMEZONE
<?php
try {
    $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
    $stmt = $conn->prepare("select r.rideId, c.idclass, cs.classsubmissionid, u.firstName, u.lastName, u.Email, c.classname, c.building, r.source, r.destination, r.startTime, r.rideStatus
                                    from User u, Class c, Ride r, ClassSubmission cs, Student s
                                        Where r.classId = c.idclass
                                        and c.classsubmissionid = cs.classsubmissionid
                                        and cs.idstudent = s.idstudent
                                        and s.UserId = u.UserId
                                        and c." . $_SESSION["ShowThisDay"] . "=1
                                        Order by r.rideStatus, r.startTime");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $address = "Pickup Location: " . $row["source"] . " -> Dropoff Location: " . $row["destination"];
            $summary = $row["firstName"] . " " . $row["lastName"] . " to " . $row["classname"] . " in " . AllBuilding_Lookup($row["building"]);
            $description = 'Pickup Time: ' . convertToTwelveHr($row["startTime"]) . '\nPickup Location: ' . $row["source"] . '\nDrop Off Location: ' . $row["destination"] . '\n\nPlease call the Center for Students with Disabilities at 262-472-4712 to make any changes to this ride.';
            if ($row["rideStatus"] == 0){
                $description .= '\n\nPlease Note: This Ride is currently marked as "Inactive".';
                $summary = 'Inactive: ' . $summary;
            }
        ?>
BEGIN:VEVENT
ORGANIZER:transcsd@uww.edu
ATTENDEE;CN="<?php echo $row["lastName"] . ", " . $row["firstName"];?>";ROLE=REQ-PARTICIPANT;PART-STAT=NEEDS-ACTION;RSVP=TRUE:mailto:<?php echo$row["Email"];?> 
DTEND;TZID=America/Chicago:<?php echo relDateToCal($reldate, endTime($row["startTime"])); ?> 
UID:<?php echo  uniqid(); ?> 
DTSTAMP:<?php echo  dateToCal(time()); ?> 
LOCATION:<?php echo  escapeString($address); ?> 
DESCRIPTION:<?php echo  escapeString($description); ?> 
URL;VALUE=URI:<?php echo  escapeString($uri); ?> 
SUMMARY:<?php echo  escapeString($summary); ?> 
DTSTART;TZID=America/Chicago:<?php echo  relDateToCal($reldate, $row["startTime"]); ?> 
END:VEVENT
BEGIN:VALARM
ACTION:DISPLAY
DESCRIPTION:<?php echo  escapeString($description); ?> 
TRIGGER:-PT15M
END:VALARM
<?php
        }
    }
} catch (PDOException $e) {
    
}
?>
END:VCALENDAR