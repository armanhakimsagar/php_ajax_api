API SEARCH AJAX PROJECT :


1. api.php (fetch all data here & json encode)
 
   header('Content-Type: application/json');
  
   $connect = mysqli_connect("localhost", "root", "", "coo");  
   $sql = "SELECT * FROM apps_countries";  
   $result = mysqli_query($connect, $sql);  
   $json_array = array();  
   while($row = mysqli_fetch_assoc($result))  
   {  
		$json_array[] = $row;  
   }  
   echo json_encode($json_array);  
   

---------



2. view_data.php (fetch ecpected data by ajax uri from | json decode | output data )

    
		if(isset($_GET['search'])){
			
			$search_data = $_GET['search'];
		
			$result = file_get_contents('http://localhost/social/api.php');

			$data = json_decode($result, TRUE);
			
			foreach ($data as $datas){
				
				if($datas['country_name'] == $search_data){
					echo $datas['country_name'];
				}
			
			};
		
		}
    
  
 ----------
 

search_ajax.php ( form | ajax query | desired sucess message ) :

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    
function post(){

  var search = document.getElementById("search").value;


  if(search)
  {
    $.ajax
    ({
      type: 'get',
      url: 'view_data.php?search='+search,
      data: 
      {
         search_data:search
      },
      success: function (response) {
    		
	  document.getElementById("view_search").innerHTML=response;
        
      }
    });
  }
  
  return false;
}

</script>



<form onSubmit="return post()">
  <input type="text" name="search" id="search">
  <button type="submit">search</button>
</form>

<div id="view_search"></div> 