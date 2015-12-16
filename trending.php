<?
/* ****************************************************************** */
function search_popularity_update($q)
{
global $db_connection;

$q_date    = date('Y-m-d H:i:sO');
$old_date  = date('Y-m-d H:i:sO', strtotime('-1 week'));

// DISCARD SEARCHES WITH NUMBERS IN THE TEXT - THEY ARE ALL LOOKING FOR DATES OR BIBLE PASSAGES, NOT IN OUR INDEX
$q_str     = very_clean_string($q);
if (preg_match('[0-9]', $q_str))
{
return;
}

// CONSTRUCT THE SOUNDEX AND METAPHONE, ACCOUNTING FOR PLURALS BY UNCONDITIONALLY ADDING LETTER 'S' TO THE END
$q_plural   = strtoupper($q_str) . 'S';
$q_phone    = metaphone($q_plural);
$q_dex      = soundex($q_plural);

// FIND IDENTICAL SEARCH TERMS IN OUR DB TABLE
$sql         = "SELECT * FROM TOP_SEARCH_TERMS WHERE search_phone = \"$q_phone\" AND search_dex = \"$q_dex\" LIMIT 1";
if (!$result = mysqli_query("$sql", $db_connection)) { fatal_error($sql); }
$row         = mysqli_fetch_assoc($result);

// IF NO IDENTICAL TERMS, INSERT THIS INTO THE TABLE
if (empty($row))
{
$sql      = "INSERT INTO TOP_SEARCH_TERMS ( search_term, search_phone, search_dex, search_date, search_score, search_total ) ";
$sql     .= "                     VALUES ( \"$q_str\",    \"$q_phone\", \"$q_dex\", \"$q_date\",     1,            1      ) ";
if (!$result= mysqli_query("$sql", $db_connection)) { fatal_error ($sql); }
} else
{
// INCREMENT THE SEARCH POPULARITY BY INCREASING THE COUNT
$search_score    = $row["search_score"] + 1;
$search_total    = $row["search_total"] + 1;
$_key            = $row["_key"];
$sql      = "UPDATE TOP_SEARCH_TERMS SET ";
$sql     .= "search_score = $search_score, ";
$sql     .= "search_total = $search_total, ";
$sql     .= "search_date = \"$q_date\" ";
$sql     .= "WHERE _key = $_key LIMIT 1";
if (!$result= mysqli_query("$sql", $db_connection)) { fatal_error ($sql); }
}

// REDUCES THE SEARCH POPULARITY SCORE AS THE AGE OF OLDER SEARCHES INCREASES
$sql         = "SELECT * FROM TOP_SEARCH_TERMS WHERE search_date < \"$old_date\"";
if (!$result = mysqli_query("$sql", $db_connection)) { fatal_error ($sql); }
while ($row  = mysqli_fetch_assoc($result))
{
$_key        = $row["_key"];
$score       = $row["search_score"];
$last_date   = $row["search_date"];
$new_date    = date('Y-m-d H:i:sO', (strtotime($last_date) + (1 * 24 * 60 * 60)));    // MOVE SEARCH DATE FORWARD
$score--;                                                                            // DECREMENT POPULARITY SCORE

$u_sql       = "UPDATE TOP_SEARCH_TERMS SET search_score = $score, search_date = \"$new_date\" WHERE _key = $_key LIMIT 1";
if (!$u_result= mysqli_query("$u_sql", $db_connection)) { fatal_error ($u_sql); }
}

// IF THE POPULARITY SCORE GOES BELOW ZERO, DROP IT
$d_sql        = "DELETE FROM TOP_SEARCH_TERMS WHERE search_score < 0";
if (!$d_result= mysqli_query("$d_sql", $db_connection)) { fatal_error ($d_sql); }
return;
}
/* ****************************************************************** */
?>