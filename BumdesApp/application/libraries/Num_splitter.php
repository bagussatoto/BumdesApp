<?php
class Num_splitter extends CI_Loader{

	public function Split($isi,$index=null){
		$jawaban = array();
		$huruf=null;
		$angka=null;

		if ($index==null) {
			for ($i=0; $i <strlen($isi) ; $i++) { 
			# code...
			if (($isi[$i]=='A')||($isi[$i]=='B')||($isi[$i]=='C')||($isi[$i]=='D')||($isi[$i]=='E')||($isi[$i]=='F')||($isi[$i]=='G')||($isi[$i]=='H')||($isi[$i]=='I')||($isi[$i]=='J')||($isi[$i]=='K')||($isi[$i]=='L')||($isi[$i]=='M')||($isi[$i]=='N')||($isi[$i]=='O')||($isi[$i]=='P')||($isi[$i]=='Q')||($isi[$i]=='R')||($isi[$i]=='S')||($isi[$i]=='T')||($isi[$i]=='U')||($isi[$i]=='V')||($isi[$i]=='W')||($isi[$i]=='X')||
				($isi[$i]=='Y')||($isi[$i]=='Z')) {
				# code...
				$huruf.=$isi[$i];
			}else if (($isi[$i]=='1')||($isi[$i]=='2')||($isi[$i]=='3')||($isi[$i]=='4')||($isi[$i]=='5')||($isi[$i]=='6')||($isi[$i]=='7')||($isi[$i]=='8')||($isi[$i]=='9')||($isi[$i]=='0')) {

				$angka.=$isi[$i];
				# code...
			}
		}
			# code...
		}else{
			for ($i=($index-1); $i <strlen($isi) ; $i++) { 
			# code...
			if (($isi[$i]=='A')||($isi[$i]=='B')||($isi[$i]=='C')||($isi[$i]=='D')||($isi[$i]=='E')||($isi[$i]=='F')||($isi[$i]=='G')||($isi[$i]=='H')||($isi[$i]=='I')||($isi[$i]=='J')||($isi[$i]=='K')||($isi[$i]=='L')||($isi[$i]=='M')||($isi[$i]=='N')||($isi[$i]=='O')||($isi[$i]=='P')||($isi[$i]=='Q')||($isi[$i]=='R')||($isi[$i]=='S')||($isi[$i]=='T')||($isi[$i]=='U')||($isi[$i]=='V')||($isi[$i]=='W')||($isi[$i]=='X')||
				($isi[$i]=='Y')||($isi[$i]=='Z')) {
				# code...
				$huruf.=$isi[$i];
			}else if (($isi[$i]=='1')||($isi[$i]=='2')||($isi[$i]=='3')||($isi[$i]=='4')||($isi[$i]=='5')||($isi[$i]=='6')||($isi[$i]=='7')||($isi[$i]=='8')||($isi[$i]=='9')||($isi[$i]=='0')) {

				$angka.=$isi[$i];
				# code...
			}
		}
			# code...
		}

		$jawaban['huruf']=$huruf;
		$jawaban['angka']=$angka;

		return $jawaban;

	}

	public function tanggal($tanggal1, $tanggal2){

			$diff = abs($tanggal1 - $tanggal2);
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));

			return $months;
	}

	public function linked(){

	}

	public function set_linked(){
		
	}

}
