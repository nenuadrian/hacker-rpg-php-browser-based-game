<?php

namespace Model;

class DBMock extends \Model {

  public static function query($db, $query) {
    $type = strtolower(substr(trim($query), 0, 6));
    try {
    if ($type == 'select') {

          $ret = $db->query($query);
          $output = array();
          while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
              $output[] = $row;
          }
        

         return array(true, $output);
      } elseif ($type == 'insert') {
        $db->exec($query);
          return array(true, 'Inserted');
      } elseif ($type == 'update') {
        $db->exec($query);
          return array(true, 'Updated');
      } elseif ($type == 'delete') {
        $db->exec($query);
          return array(true, 'Deleted');
      }

    } catch (\Exception $ex) {
        return array(false, $db->lastErrorMsg());
    }
  }
  public static function allowed($query) {
    $type = strtolower(substr(trim($query), 0, 6));
    return in_array($type, array('select', 'insert', 'update', 'delete'));
  }
  public static function get_db($identifier, $purpose) {
    $sql_path = APPPATH . 'tmp';
    $sql_filename = $purpose . '_' . $identifier . '.db';
    $sql_file = $sql_path . '/' . $sql_filename;

    $db = new \SQLite3($sql_file);

    return $db;
  }

  public static function get_fresh_db($identifier, $purpose) {
    $sql_path = APPPATH . 'tmp';
    $sql_filename = $purpose . '_' . $identifier . '.db';
    $sql_file = $sql_path . '/' . $sql_filename;
    //File::delete($sql_file);
    if (!\File::exists($sql_file))
        \File::create($sql_path, $sql_filename, '');
    else \File::update($sql_path, $sql_filename, '');

    $db = new \SQLite3($sql_file);

    return $db;
  }

  public static function run_sql(&$db, $sql) {
    $sql = array_filter(static::split_sql_file($sql));

    foreach ($sql as $s)
      $db->exec($s);
  }

  private static function split_sql_file($sql, $delimiter = ';') {
   // Split up our string into "possible" SQL statements.
   $tokens = explode($delimiter, $sql);

   // try to save mem.
   $sql = "";
   $output = array();

   // we don't actually care about the matches preg gives us.
   $matches = array();

   // this is faster than calling count($oktens) every time thru the loop.
   $token_count = count($tokens);
   for ($i = 0; $i < $token_count; $i++)
   {
      // Don't wanna add an empty string as the last thing in the array.
      if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
      {
         // This is the total number of single quotes in the token.
         $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
         // Counts single quotes that are preceded by an odd number of backslashes,
         // which means they're escaped quotes.
         $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

         $unescaped_quotes = $total_quotes - $escaped_quotes;

         // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
         if (($unescaped_quotes % 2) == 0)
         {
            // It's a complete sql statement.
            $output[] = $tokens[$i];
            // save memory.
            $tokens[$i] = "";
         }
         else
         {
            // incomplete sql statement. keep adding tokens until we have a complete one.
            // $temp will hold what we have so far.
            $temp = $tokens[$i] . $delimiter;
            // save memory..
            $tokens[$i] = "";

            // Do we have a complete statement yet?
            $complete_stmt = false;

            for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
            {
               // This is the total number of single quotes in the token.
               $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
               // Counts single quotes that are preceded by an odd number of backslashes,
               // which means they're escaped quotes.
               $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

               $unescaped_quotes = $total_quotes - $escaped_quotes;

               if (($unescaped_quotes % 2) == 1)
               {
                  // odd number of unescaped quotes. In combination with the previous incomplete
                  // statement(s), we now have a complete statement. (2 odds always make an even)
                  $output[] = $temp . $tokens[$j];

                  // save memory.
                  $tokens[$j] = "";
                  $temp = "";

                  // exit the loop.
                  $complete_stmt = true;
                  // make sure the outer loop continues at the right point.
                  $i = $j;
               }
               else
               {
                  // even number of unescaped quotes. We still don't have a complete statement.
                  // (1 odd and 1 even always make an odd)
                  $temp .= $tokens[$j] . $delimiter;
                  // save memory.
                  $tokens[$j] = "";
               }

            } // for..
         } // else
      }
   }

   return $output;
}

}
