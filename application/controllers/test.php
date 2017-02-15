<?php
class Test extends Frontend_Controller
{
   public function __construct() {
      parent::__construct();
   }

   public function index() {

    echo strtoupper($this['site_title']);
/*
    require APPPATH.'libraries/Instamojo.php';

    $api = new Instamojo('[API_KEY]', '[AUTH_TOKEN]');

    try {
        $response = $api->linkCreate(array(
            'title'=>'Hello API',
            'description'=>'Create a new Link easily',
            'base_price'=>100,
            'currency'=>'INR',
            'cover_image'=>'/path/to/photo.jpg'
            ));
        print_r($response);
    }
    catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }
*/
//$this->load->view('test', $this->data);
   }

   public function extra() {

      /*
      51 - 1
      52 - 2
      53 - 4
      54 - 3
      55 - 5
      */

      $mark_list[0] = new stdClass();
      $mark_list[0]->user_id = '51';
      $mark_list[0]->score = '10';
      $mark_list[0]->correct_starred = '3';
      $mark_list[0]->attempted = '15';
      $mark_list[0]->rank = '1';

      $mark_list[1] = new stdClass();
      $mark_list[1]->user_id = '52';
      $mark_list[1]->score = '10';
      $mark_list[1]->correct_starred = '3';
      $mark_list[1]->attempted = '15';
      $mark_list[1]->rank = '1';

      $mark_list[2] = new stdClass();
      $mark_list[2]->user_id = '53';
      $mark_list[2]->score = '8';
      $mark_list[2]->correct_starred = '2';
      $mark_list[2]->attempted = '12';
      $mark_list[2]->rank = '1';

      $mark_list[3] = new stdClass();
      $mark_list[3]->user_id = '54';
      $mark_list[3]->score = '8';
      $mark_list[3]->correct_starred = '3';
      $mark_list[3]->attempted = '13';
      $mark_list[3]->rank = '1';

      $mark_list[4] = new stdClass();
      $mark_list[4]->user_id = '55';
      $mark_list[4]->score = '5';
      $mark_list[4]->correct_starred = '3';
      $mark_list[4]->attempted = '10';
      $mark_list[4]->rank = '1';

      $enroll_list[51] = new stdClass();
      $enroll_list[51]->date_time = '2015-10-01';

      $enroll_list[52] = new stdClass();
      $enroll_list[52]->date_time = '2015-10-02';

      $enroll_list[53] = new stdClass();
      $enroll_list[53]->date_time = '2015-10-01';

      $enroll_list[54] = new stdClass();
      $enroll_list[54]->date_time = '2015-10-01';

      $enroll_list[55] = new stdClass();
      $enroll_list[55]->date_time = '2015-10-01';

      $len = count($mark_list);

         for ($i = 0; $i < $len; $i++) {
            for ($j = 0; $j < $len; $j++) {
               if($i != $j) {

                  if($mark_list[$j]->score < $mark_list[$i]->score) {
                     $mark_list[$j]->rank += 1;
                  } elseif($mark_list[$j]->score == $mark_list[$i]->score) {
                     
                     if($mark_list[$j]->correct_starred < $mark_list[$i]->correct_starred) {
                        $mark_list[$j]->rank += 1;
                     } elseif($mark_list[$j]->correct_starred == $mark_list[$i]->correct_starred) {

                        if($mark_list[$j]->attempted < $mark_list[$i]->attempted) {
                           $mark_list[$j]->rank += 1;
                        } elseif($mark_list[$j]->attempted == $mark_list[$i]->attempted) {

                           if(strtotime($enroll_list[$mark_list[$j]->user_id]->date_time) >= strtotime($enroll_list[$mark_list[$i]->user_id]->date_time)) {
                              $mark_list[$j]->rank += 1;
                           }
                        }
                     }
                  }

               }
            }
         }

         foreach ($mark_list as $m) {
            echo $m->user_id.' - '.$m->rank.'<br>';
         }

         var_dump($mark_list);
   }

/*
Logged in:

array (size=10)
  'session_id' => string 'b3961cfd9d7121ba496eb373e5820a7f' (length=32)
  'ip_address' => string '::1' (length=3)
  'user_agent' => string 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0' (length=72)
  'last_activity' => int 1430243334
  'user_data' => string '' (length=0)
  
  'identity' => string 'jithin2233@gmail.com' (length=20)
  'username' => string 'jithin k' (length=8)
  'email' => string 'jithin2233@gmail.com' (length=20)
  'user_id' => string '4' (length=1)
  'old_last_login' => string '1430243278' (length=10)

Not Logged in:

array (size=5)
  'session_id' => string 'f58e5e17eab733e6cd2d815117ac919a' (length=32)
  'ip_address' => string '::1' (length=3)
  'user_agent' => string 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0' (length=72)
  'last_activity' => int 1430243672
  'user_data' => string '' (length=0)


*/

/*
  sample user:

  email: sharath@gmail.com
  p/w: password
*/



/*
  $start_time = new DateTime(date('Y-m-d').' '.$x->start_time);
  $end_time = new DateTime(date('Y-m-d').' '.$x->end_time);
  $diff = $start_time->diff($end_time);

  $h = $diff->format('%h');
  $m = $diff->format('%i');
  $s = $diff->format('%s');

  $end = new DateTime(date('Y-m-d H:i:s'));
  $end->modify('+'.$h.'hours +'.$m.'minutes +'.$s.'seconds');

  $now = new DateTime(date('Y-m-d H:i:s'));

  var_dump($now, $diff, $end);
*/





}
?>