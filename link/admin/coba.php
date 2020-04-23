<?php
$a_page = 1;
for($l=1;$l<=2;$l++){
	if($l == $a_page){
		echo"
			<a href='pengajuan-$l' class='active'>$l</a>
		";
	}else{
		echo"
			<a href='pengajuan-$l'>$l</a>
		";
	}
}
?>