<?php

require_once('../_helpers/strip.php');

// this database contains a table with 2 rows
$db = new SQLite3('test.db');

$id = $_GET['id'];

if (strlen($id) > 0) {
  // view a particular secret
  //
  // As can be seen in the code, the overview page only selects rows
  // from the secrets table WHERE user_id = 1. However, the query
  // below does not have a similar clause OR any kind of authorization
  // check to make sure that the user is authorized to see secret.
  // This means any ID can be passed in the ?id= parameter and be
  // used to read any secret from the table.
  $query = $db->query('select * from secrets where id = ' . (int)$id);

  while ($row = $query->fetchArray()) {
    echo 'Secret: ' . $row['secret'];
  }

  echo '<br /><br /><a href="/">Go back</a>';
} else {
  // view all the user's secrets (WHERE user_id = 1)
  $query = $db->query('select * from secrets where user_id = 1');

  echo '<strong>Your secrets</strong><br /><br />';

  while ($row = $query->fetchArray()) {
    echo '<a href="/?id=' . $row['id'] . '">#' . $row['id'] . '</a><br />';
  }
