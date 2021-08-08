<?php
class Meta_info extends CI_Model {

  function getTitleForCars() {

    if($this->uri->segment(1)=='ar'){
      $make = str_replace("-", " ", $this->uri->segment(3)); 
      //echo $make;
    }else{
      $make = str_replace("-", " ", $this->uri->segment(2));
      //echo $make;
    }

    if($this->uri->segment(1)=='ar'){
      $model = str_replace("-", " ", $this->uri->segment(4));
    }else{
      $model = str_replace("-", " ", $this->uri->segment(3));
    }

    $city = str_replace("-", " ", $this->input->get('city'));  

    // if($make && $city){
    //   $title='Used '.$make.' for sale in '.$city.' | '.$make.' price in '.$city.' | Auto Traders';
    // }else if($make && $model && $city){
    //   $title='Used '.$make.' '.$model.' for sale in '.$city.' | '.$make.' '.$model.' price in '.$city.' | Auto Traders';   
    // }else if($make && $model){
    //   $title='Used '.$make.' '.$model.' for sale in Dubai | '.$make.' '.$model.' price in Dubai | Auto Traders';   
    // }else if($city){
    //   $title='Used Cars for sale in '.$city.' | '.$city.' used cars | Used Cars price in '.$city.' | Auto Traders';   
    // }else if($make){
    //   $title='Used '.$make.' for sale in Dubai | Dubai used cars | '.$make.' price in Dubai | Auto Traders';   
    // }else{
    //   $title='Used cars for sale in dubai | Dubai used cars | Luxury cars for sale in dubai | Auto Traders';
    // }

    if($make == 'mercedes benz'){
      $title='1500 Used Mercedes-Benz for Sale in Dubai | Buy Used Mercedes-Benz in Dubai | Auto Traders';
    }elseif($make == 'bentley'){
      $title='Used Bentley for sale in UAE | Bentley used car prices in Dubai | Auto Traders';
    }elseif($make == 'bmw'){
      $title='Used BMW for sale in UAE | Buy used BMW cars in Dubai at best price | Auto Traders';
	}elseif($make == 'toyota'){
      $title='Toyota used cars in Dubai | Toyota used cars for sale in UAE | Auto Traders';
    }elseif($make == 'audi' && $model == 'a1'){
      $title='Audi A1';
    }elseif($make == 'audi'){
      $title='Used Audi cars for sale in Dubai | Buy Audi cars in Dubai, UAE | Auto Traders';
    }elseif($make == 'ferrari'){
      $title='Used Ferrari for Sale in Dubai | New & Used Ferrari Car in Dubai Price| Auto Traders';
    }elseif($make == 'chevrolet'){
      $title='Used Chevrolet Cars for Sale in Dubai | Second Hand Chevrolet Cars in Dubai | Auto Traders';
    }elseif($make == 'lamborghini'){
      $title='Lamborghini used cars for sale in Dubai | Lamborghini second hand cars price in Dubai | Auto Traders';
    }elseif($make == 'bugatti'){
      $title='Used Bugatti cars for sale in Dubai | Bugatti latest model price in Dubai | Auto Traders';
	}elseif($make == 'volvo'){
      $title='Used Volvo cars for sale in Dubai | Used Volvo cars for sale in UAE | Auto Traders';
	}elseif($make == 'land rover'){
      $title='Used land rover for sale in UAE | Used land rover for sale in Dubai | Auto Traders';
	}elseif($make == 'volkswagen'){
      $title='Used Volkswagen for sale in Dubai | Used Volkswagen for sale in UAE | Auto Traders';
	}elseif($make == 'suzuki'){
      $title='Used Suzuki cars for sale in UAE | Used Suzuki cars for sale in Dubai| Auto Traders';
	}elseif($make == 'subaru'){
      $title='Used Subaru car for sale in Dubai | Used Subaru car for sale in UAE | Auto Traders';
    }elseif($make == 'aston martin'){
      $title='Used Aston Martin for Sale Dubai | Buy Used Aston Martin Cars in UAE | Auto Traders';
	}elseif($make == 'buick'){
      $title='Buick used cars for sale in Dubai | Buick cars for sale online | Auto Traders';
	}elseif($make == 'cadillac'){
      $title='Cadillac used cars for sale in Dubai | Used Cadillac cars in UAE | Auto Traders';
	 }elseif($make == 'chery'){
      $title='Used Chery cars for sale in Dubai | Chery car price in UAE | Auto Traders';
	}elseif($make == 'chrysler'){
      $title='Used Chrysler cars for sale in Dubai | Used Chrysler 300 for sale in UAE | Auto Traders';
	}elseif($make == 'daewoo'){
      $title='Daewoo used cars for sale in Dubai | Used daewoo matiz cars for sale | Auto Traders';
	}elseif($make == 'brilliance'){
      $title='Used Brilliance for sale in Dubai | Brilliance used car for sale in UAE | Auto Traders';
	}elseif($make == 'dodge'){
      $title='Used Dodge cars for sale in Dubai | Dodge charger for sale in UAE | Auto Traders';
	}elseif($make == 'fiat'){
      $title='Fiat used cars Dubai | Fiat cars for sale in UAE | Auto Traders';
	}elseif($make == 'ford'){
      $title='Ford used cars Dubai | Used ford mustang for sale in Dubai | Auto Traders';
	}elseif($make == 'geely'){
      $title='Geely used cars in UAE | Used Geely cars for sale in UAE | Auto Traders';
	}elseif($make == 'gmc'){
      $title='GMC cars in Dubai | GMC used cars in Dubai | Auto Traders';
	}elseif($make == 'honda'){
      $title='Honda used cars Dubai | Honda used cars for sale in UAE | Auto Traders';
	}elseif($make == 'porsche'){
      $title='Used porsche Dubai | Porsche used cars in Dubai | Auto Traders';
	}elseif($make == 'smart'){
      $title='Smart car for sale in UAE | Used smart for sale in Dubai | Auto Traders';
	}elseif($make == 'daihatsu'){
      $title='Used Daihatsu cars for sale in Dubai | Used Daihatsu terios for sale in UAE | Auto Traders';
	}elseif($make == 'tesla'){
      $title='Used Tesla cars for sale in UAE | Used Tesla cars price in Dubai | Auto Traders';
  
  }else{
      $title='Used cars in Dubai | Used cars for sale in UAE | Auto Traders';
  }

    return $title;

  }

  function getTitleForCarDetails() {
    if($this->uri->segment(1)=='ar'){
      $make = str_replace("-", " ", $this->uri->segment(3));
      $model = str_replace("-", " ", $this->uri->segment(4));
      $title=''.$make.' '.$model.' for sale in dubai | Auto Traders';
    }else{
      $make = str_replace("-", " ", $this->uri->segment(2));
      $model = str_replace("-", " ", $this->uri->segment(3));
      $title=''.$make.' '.$model.' for sale in dubai | Auto Traders';
    }   

    return $title;
    
  }

  function getTitle(){
    $ct1=$this->uri->rsegment(1);
    $ct2=$this->uri->rsegment(2);  
    
    switch($ct1){
      case 'home':
				$title='Used cars for sale in UAE | Buy used cars in Dubai | Auto Traders';
      break; 
      case 'cars':
        $title = $this->getTitleForCars();
        //$title='Used cars in Dubai | Used cars for sale in UAE | Auto Traders ';
      break; 
      case 'cardetails':
        $title = $this->getTitleForCarDetails();
      break; 
      case 'numberplates':
				$title='Dubai number plates for sale | car number plate in Dubai | Auto Traders';
      break; 
      case 'boats':
				$title='Used boats for sale in dubai | Used yachts for sale in dubai | luxury yacht for sale in dubai | Auto Traders';
      break;
      case 'bikes':
				$title='Used bike for sale in Dubai | New bikes for sale in Dubai | Auto Traders';
      break;
      case 'mobilenumbers':
				$title='VIP mobile numbers for sale in dubai | fancy mobile number for sale in dubai | Auto Traders';
      break;
      case 'dealer':
				$title='Car dealerships in dubai | Find car dealerships in dubai | Auto Traders';
      break;
      case 'dealers':
				$title='Car dealers in Dubai | Used car dealers in Dubai | Best car dealers in Dubai | Auto Traders';
      break;
      case 'about':
        $title='About Auto Traders | Used cars for sale in Dubai | Auto Traders';
      break;
      case 'contact':
        $title='Contact Auto Traders | Used cars for sale in Dubai | Auto Traders';
      break;
      case 'terms':
        $title='Terms and conditions | Auto Traders';
      break;
      case 'postad':
        $title='Post an AD | Auto Traders';
      break;
      case 'myads':
        $title='My Ads | Auto Traders';
      break;
      case 'myaccount':
        $title='My Account | Auto Traders';
      break;
      case 'login':
        $title='Login | Auto Traders';
      break;
    } 

    echo $title;
    
  }

  function getDescriptionForCars() {

    if($this->uri->segment(1)=='ar'){
      $make = str_replace("-", " ", $this->uri->segment(3));
    }else{
      $make = str_replace("-", " ", $this->uri->segment(2));
    }

    if($this->uri->segment(1)=='ar'){
      $model = str_replace("-", " ", $this->uri->segment(4));
    }else{
      $model = str_replace("-", " ", $this->uri->segment(3));
    }

    $city = str_replace("-", " ", $this->input->get('city'));  

    // if($make && $city){
    //   $title='Buy and sell used '.$make.' for sale in '.$city.' is now easy on Auto Traders. Find thousands of used '.$make.' in '.$city.' with the best price.';
    // }else if($make && $model && $city){
    //   $title='Buy and sell used '.$make.' '.$model.' for sale in '.$city.' is now easy on Auto Traders. Find thousands of used '.$make.' '.$model.' in '.$city.' with the best price..';  
    // }else if($make && $model){
    //   $title='Buy and sell used '.$make.' '.$model.' for sale in Dubai is now easy on Auto Traders. Find thousands of used '.$make.' '.$model.' in Dubai with the best price.'; 
    // }else if($city){
    //   $title='Buy and sell used cars for sale in '.$city.' is now easy on Auto Traders. Find thousands of used cars in '.$city.' with the best price.';
    // }else if($make){
    //   $title='Buy and sell used '.$make.' for sale in Dubai is now easy on Auto Traders. Find thousands of used '.$make.' with the best price.';  
    // }else{
    //   $title='Buy and sell used cars for sale in Dubai is now easy on Auto Traders. Find thousands of used cars in Dubai of all brands.'; 
    // }

    if($make == 'mercedes benz'){
      $title='Buy used Mercedes-Benz in Dubai or sell second hand Mercedes-Benz in Dubai at best price. Auto Traders offers 35 Mercedes Benz car models and 18 different colors. Check out best used Mercedes price in Dubai.';
    }elseif($make == 'bentley'){
      $title='Used Bentley for sale in Dubai from 62,000 AED. Buy 2nd hand Bentley cars in Dubai at best price. Check the wide range of used Bentley cars for sale in UAE from trusted car Dealers.';
    }elseif($make == 'toyota'){
      $title='Buy and Sell Toyota used cars in Dubai, UAE at Auto Traders. Find a wide range of verified second-hand Toyota used cars for sale in Dubai. Used Toyota car price is starting from 1100 AED. Get the best Toyota used cars in Dubai from car owners directly.';
    }elseif($make == 'audi'){
      $title='Want to used Audi cars for sale in Dubai or buy Audi cars in UAE? Over 1500 Audi second-hand cars are for sale in Dubai from 9000 AED on Auto Traders. Check out the best Audi cars in Dubai models, price, reviews and ratings.';
    }elseif($make == 'bmw'){
      $title='Looking for used BMW cars in Dubai? Auto Traders is the best online platform to buy and sell used BMW cars in Dubai, UAE. Used BMW car price is starting from 6,000 AED. Check out BMW car models, specs and HD images.';
	}elseif($make == 'ferrari'){
      $title='Used Ferrari for sale in Dubai or buy used Ferrari cars in Dubai - Auto Traders connects you with the best Ferrari car dealers of used cars, second-hand cars and new cars in Dubai, UAE. We offer the best platform to buy and sell used Ferrari cars in Dubai. Call 971 58 933 0420 for more details.';
    }elseif($make == 'chevrolet'){
      $title='Buy Chevrolet used cars in Dubai or sell second hand Chevrolet cars in Dubai at Auto Traders. Used Chevrolet cars for sale in Dubai price starts from 3000 AED. Check out the second-hand Chevrolet cars price, HD photos and reviews.';
    }elseif($make == 'lamborghini'){
      $title='Buy and sell Lamborghini used cars in Dubai at Auto Traders. Find the largest collections of Lamborghini used cars in UAE from our expert car dealers. Check out the models, colors, reviews and price of Lamborghini used cars in Dubai.';
    }elseif($make == 'bugatti'){
      $title='Buy and sell used Bugatti cars in Dubai at Auto Traders. Check out the Bugatti latest model online. Used Bugatti car starting price is 6,000 AED. Call 971 58 933 0420 for more details.';
    }elseif($make == 'volkswagen'){
      $title='Used Volkswagens cars for sale in Dubai. Buy used Volkswagen cars in Dubai directly from car owners on Auto Traders. Used Volkswagen cars price is starting from 6500 AED.';
	}elseif($make == 'suzuki'){
      $title='Used Suzuki car for sale in Dubai and rest of UAE on Autotraders. Find your perfect used Suzuki car in Dubai today from our wide range of Suzuki pre-owned cars. Used Suzuki swift cars price starts from 8,000 AED.';
	}elseif($make == 'land rover'){
      $title='Lasted used land rover cars for sale in Dubai. Find great deals on good condition used land rover for sale in UAE with features, specifications, images and price online at Auto Traders. Used land rover cars price is starting from 2500 AED.';
	}elseif($make == 'subaru'){
      $title='Buy and sell used Subaru cars in Dubai and rest of UAE on Auto Traders. Find the best second-hand Subaru cars in Dubai from top rated used cars on Auto Traders. Used Subaru cars price starts from 6,000 AED. For more details, call +971589330420.';
	}elseif($make == 'volvo'){
      $title='Buy and sell used Volvo car in UAE at Auto Traders. Used Volvo car for sale in UAE starts from 10,500 AED. Call 971 58 933 0420 for more details.';
	}elseif($make == 'aston martin'){
      $title='Used Aston Martin for sale in Dubai online at Auto Traders. Find the best deals for used aston martin cars in UAE. Buy used aston martin cars in Dubai from 255,000 AED. Check out aston martin car price, specifications, HD images online.';
	}elseif($make == 'buick'){
      $title='Buick used cars for sale online in Dubai. We offer thousands of used Buick for sale under 10000 in Dubai. Check out the used Buick cars price, HD images and specifications. Buy Buick used cars online in Dubai from 11000 AED.';
	}elseif($make == 'cadillac'){
      $title='Cadillac used cars for sale in Dubai. Check out the used Cadillac cars price, HD images and specifications. Buy certified used Cadillac cars online in Dubai from 6000 AED.';
	}elseif($make == 'chery'){
      $title='Want to Sell used chery cars in Dubai or buy chery used cars in UAE? Visit Autotraders, we offer thousands of used chery cars for sale in Dubai. Chery car price in UAE starts from 6300 AED.';
	}elseif($make == 'chrysler'){
      $title='Chrysler used cars for sale in Dubai. Find the largest collection of used Chrysler cars in UAE with the best deal. Buy used Chrysler 300 cars in UAE at the best price. Chrysler 300 price UAE starts from 11000 AED.';
	}elseif($make == 'daewoo'){
      $title='Daewoo used cars for sale in Dubai, UAE. Find the largest collection of used daewoo cars for sale in Dubai with the best deal. Buy used daewoo cars in UAE from 4000 AED.';
	}elseif($make == 'dodge'){
      $title='Used Dodge cars for sale in Dubai from 7000 AED.  Buy used dodge cars online from the largest collection of used dodge cars in UAE with the best deal. Check out the used dodge car price in UAE on Auto Traders.';
	}elseif($make == 'fiat'){
      $title='Fiat used cars for sale in Dubai from 18000 AED. Check out the complete details, specifications, price and HD Images about used fiat cars in Dubai. Buy fiat pre-owned cars in Dubai at best price.';
	}elseif($make == 'smart'){
      $title='Buy used smart cars in Dubai or Smart car for sale in UAE on Auto Traders. Smart car price in UAE starts from 10,000 AED. Check out used smart cars price, HD images online.';
	}elseif($make == 'brilliance'){
      $title='Used Brilliance for sale in Dubai. Find the largest collections of used Brilliance in UAE on biggest online automobile marketplace in UAE. Check out the brilliance used cars price and HD images. Used Brilliance cars price starts from 9500 AED.';
	}elseif($make == 'daihatsu'){
      $title='Used Daihatsu cars for sale in Dubai starts from 4000 AED. We offer 200 used Daihatsu cars for sale in UAE with the best deal. Check out Daihatsu used cars price, HD images and specifications.';
	}elseif($make == 'ford'){
      $title='Buy Ford used cars Dubai or sell ford used cars in Dubai on Auto Traders. Check out the largest collections of used ford cars for sale in Dubai. Used ford cars in Dubai price starts from 3000 AED.';
	}elseif($make == 'geely'){
      $title='Used Geely cars for sale in UAE on Auto Traders. Buy Geely used cars in UAE from the largest collections of Geely cars UAE. Check out gGeelycar price in UAE, HD images and specifications.';
	}elseif($make == 'gmc'){
      $title='Buy GMC cars in Dubai from trusted car dealers. We offer thousands of GMC used cars for sale in Dubai. GMC car price in Dubai starts from 6000 AED. Check out GMC pre-owned car price, HD images.';
	}elseif($make == 'honda'){
      $title='Buy Honda used cars Dubai from trusted honda car dealers. We offer thousands of honda used cars for sale in UAE with the best deal. Check out used honda cars in Dubai price, specifications and HD images online.';
	}elseif($make == 'porsche'){
      $title='Want to sell used Porsche in Dubai or buy Porsche used cars Dubai? Visit Auto Traders. We offer the best deal to buy and sell used Porsche cars in Dubai. Used Porsche for sale in Dubai starts from 8000 AED.';
	}elseif($make == 'tesla'){
      $title='Sell used tesla cars in Dubai online at Auto Traders. Find a wide range of the latest models and used tesla cars in Dubai. Buy used tesla cars in Dubai from 2,00,000 AED. Call 971 58 933 0420 for more details.';
    }else{
      $title='Looking for used cars in Dubai? We have listed a wide range of used cars for sale in Dubai, Sharjah and UAE. Buy second hand cars in Dubai from top brands like Toyota, Mercedes-Benz, Nissan and Ferrari. Check out used car price in UAE.';
    }

    return $title;

  }

  function getDescForCarDetails() {
    if($this->uri->segment(1)=='ar'){
      $make = str_replace("-", " ", $this->uri->segment(3));
      $model = str_replace("-", " ", $this->uri->segment(4));
      $title='Buy and sell '.$make.' '.$model.' for sale in dubai | Auto Traders';
    }else{
      $make = str_replace("-", " ", $this->uri->segment(2));
      $model = str_replace("-", " ", $this->uri->segment(3));
      $title='Buy and sell '.$make.' '.$model.' for sale in dubai | Auto Traders';
    }   

    return $title;
    
  }
  

  function getDescription(){
    $ct1=$this->uri->rsegment(1);
    $ct2=$this->uri->rsegment(2);
    
    $title='';

    switch($ct1){
      case 'home':
				$title='Buy used cars in Dubai or sell second hand cars in Dubai on Auto Traders. Check out a wide range of used cars for sale in UAE from top brands like Toyota, Nissan, Mercedes-Benz and Ferrari. Call us for more details about used cars for sale in UAE.';
      break; 
      case 'cars':
        $title = $this->getDescriptionForCars();
        // $title='20000 used cars for sale in Dubai from top car dealers in Dubai. Buy used cars in Dubai from top brands like Toyota, Mercedes-Benz, BMW, Nissan, Bentley, Audi and Ferrari. Choose the best used car in Dubai from 220 car models. Check out the best used car price, reviews and ratings.';				
      break; 
      case 'cardetails':
        $title = $this->getDescForCarDetails();
      break; 
      case 'numberplates':
				$title='Number plates for sale in Dubai at best price. Find the largest collections of car number plates in Dubai. We offer a wide range of VIP car number plates for sale in Dubai, Sharjah, Abu Dhabi, Ajman. Buy car number plates in Dubai from 1500 AED.';
      break;    
      case 'boats':
				$title='Boats for sale in Dubai & Buy used boats in Dubai at best price. Choose from largest collections of yacht boats, fishing boats, used boats in Dubai, UAE.';
      break; 
      case 'bikes':
				$title='Used bikes for sale in Dubai. Autotraders is the best marketplace to buy used bikes in Dubai or sell second hand motorcycle in Dubai/new bikes for sale in Dubai. Visit our website or Call +971 58 933 0420 for more details.';
      break; 
      case 'mobilenumbers':
				$title='Buy and sell vip mobile number for sale in Dubai. Buy fancy mobile number';
      break;
      case 'dealer':
				$title='Car dealerships in dubai.';
      break;  
      case 'dealers':
				$title='Looking for car dealers in Dubai? Autotraders is the best online car dealer in Dubai. Visit our website to find the top car dealers in Dubai, UAE.';
      break;  
      case 'about':
				$title='Buy and sell used cars in dubai. Largest collections of luxury cars for sale in Dubai';
      break;  
      case 'contact':
				$title='Buy and sell used cars in dubai. Largest collections of luxury cars for sale in Dubai';
      break; 
      case 'terms':
				$title='Buy and sell used cars in dubai. Largest collections of luxury cars for sale in Dubai';
      break; 
           
    }

    echo $title;
    
  }

  function getKeywordsForCars() {

    if($this->uri->segment(1)=='ar'){
      $make = str_replace("-", " ", $this->uri->segment(3)); 
      //echo $make;
    }else{
      $make = str_replace("-", " ", $this->uri->segment(2));
      //echo $make;
    }

    if($this->uri->segment(1)=='ar'){
      $model = str_replace("-", " ", $this->uri->segment(4));
    }else{
      $model = str_replace("-", " ", $this->uri->segment(3));
    }

    $city = str_replace("-", " ", $this->input->get('city'));  

    // if($make && $city){
    //   $title='Used '.$make.' for sale in '.$city.' | '.$make.' price in '.$city.' | Auto Traders';
    // }else if($make && $model && $city){
    //   $title='Used '.$make.' '.$model.' for sale in '.$city.' | '.$make.' '.$model.' price in '.$city.' | Auto Traders';   
    // }else if($make && $model){
    //   $title='Used '.$make.' '.$model.' for sale in Dubai | '.$make.' '.$model.' price in Dubai | Auto Traders';   
    // }else if($city){
    //   $title='Used Cars for sale in '.$city.' | '.$city.' used cars | Used Cars price in '.$city.' | Auto Traders';   
    // }else if($make){
    //   $title='Used '.$make.' for sale in Dubai | Dubai used cars | '.$make.' price in Dubai | Auto Traders';   
    // }else{
    //   $title='Used cars for sale in dubai | Dubai used cars | Luxury cars for sale in dubai | Auto Traders';
    // }

    if($make == 'mercedes benz'){
      $title='Used mercedes benz for sale in dubai, benz for sale in dubai, used mercedes-benz for sale, buy used mercedes benz in Dubai, used mercedes benz dubai, best used mercedes benz in Dubai, mercedes benz dubai price list, 2nd hand mercedes benz for sale, used mercedes for sale in dubai, used mercedes dubai price.';
    }elseif($make == 'bentley'){
      $title='Used bentley for sale in uae, used bentley for sale in dubai, used bentley cars for sale in dubai, used bentley gtc for sale, bentley for sale in uae, bentley price in uae, used bentley for sale in abu dhabi, buy used bentley car in Dubai, bentley used car prices, cheap used bentley for sale.';
    }elseif($make == 'bmw'){
      $title='Used BMW car in UAE, used BMW car, BMW second hand Dubai, used BMW 320i car, BMW x5 for sale in Dubai, BMW x5 for sale in Dubai, used BMW x5 for sale in Dubai, used BMW for sale in uae, Used BMW X3 series car, used BMW, Price of used BMW car and pre-owned BMW cars.';
	}elseif($make == 'toyota'){
      $title='Toyota used cars in Dubai, Toyota used cars in sharjah, toyota pre owned cars dubai, toyota used cars for sale in dubai, toyota rav4 used cars for sale in dubai, toyota corolla used cars for sale in dubai, toyota camry used cars for sale in dubai, used land cruiser for sale in dubai, toyota pre owned dubai, used toyota land cruiser v8 for sale in dubai, used toyota highlander for sale in dubai, used toyota for sale in dubai.';
    }elseif($make == 'audi'){
      $title='Audi used cars for sale in dubai, Audi cars for sale in Dubai, Audi used cars in UAE, used audi car for sale in dubai, audi q7 for sale in dubai, Audi second hand cars in Dubai, audi s3 for sale dubai, audi q5 for sale dubai, Audi cars in Dubai.';
    }elseif($make == 'ferrari'){
      $title='Used ferrari for sale in dubai, used ferrari 458 for sale in dubai, ferrari for sale in dubai, ferrari price in dubai, ferrari f12 tdf for sale dubai, ferrari 458 for sale dubai, ferrari 488 for sale dubai, ferrari 812 for sale dubai, used ferrari for sale UAE, ferrari Dubai price.';
    }elseif($make == 'chevrolet'){
      $title='Used Chevrolet cars for sale in Dubai, Chevrolet used cars in Dubai, second hand Chevrolet cars in Dubai, Chevrolet cruze used cars in Dubai, Chevrolet cars price list in Dubai, Chevrolet cars for sale in Dubai, Chevrolet cars in Dubai, Chevrolet cars price in Dubai, Chevrolet camaro for sale in dubai, Chevrolet camaro price in dubai, Chevrolet dealer Dubai.';
    }elseif($make == 'lamborghini'){
      $title='Lamborghini used car in Dubai, Lamborghini cars for sale in Dubai, Lamborghini pre owned cars in Dubai, Lamborghini cars price in Dubai, Lamborghini buy in Dubai, used Lamborghini cars for sale, Lamborghini cars price list in uae, Lamborghini aventador used car, Lamborghini used car Dubai, buy Lamborghini car online, Lamborghini used cars in UAE, Lamborghini second hand cars in Dubai.';
    }elseif($make == 'bugatti'){
      $title='Used bugatti cars for sale in Dubai, bugatti used cars for sale in Dubai, bugatti for sale Dubai, bugatti car price in Dubai, bugatti veyron price, bugatti top model, bugatti latest model, bugatti new car price, used bugatti cars for sale in Sharjah, bugatti car starting price, used bugatti cars for sale in Abu Dhabi, used bugatti cars for sale in Ajman, used bugatti cars for sale in Ajman.';
    }elseif($make == 'volvo'){
      $title='Used Volvo cars for sale in Dubai, used Volvo cars for sale in UAE, Volvo xc90 for sale Dubai, used Volvo cars in Dubai, Volvo xc90 price in UAE, Volvo xc90 2019 price in UAE, Volvo secondhand cars, Volvo xc90 second hand, best used Volvo car, Volvo xc90 for sale Dubai, Volvo used car Dubai, Volvo for sale in UAE.';
	}elseif($make == 'volkswagen'){
      $title='Used gti for sale in UAE, used Volkswagen golf for sale in UAE, used golf gti for sale UAE, used golf r for sale UAE, used golf r for sale Dubai, used golf r32 for sale UAE, used Volkswagen beetle for sale in UAE, used gti for sale in UAE, used Volkswagen caddy for sale in UAE, used Volkswagen used car Dubai.';
	}elseif($make == 'suzuki'){
      $title='Used Suzuki cars for sale in UAE, used Suzuki jimny for sale in UAE, used Suzuki vitara for sale in UAE, Used Suzuki jimny 2019 for sale UAE, Used Suzuki jimny UAE for sale, Suzuki swift used car for sale in UAE, used Suzuki swift price in UAE, used maruti Suzuki Dubai, Suzuki pre owned car Dubai, used Suzuki jimny for sale in Dubai.';
	}elseif($make == 'subaru'){
      $title='Used Subaru car price, used xv car price, used 2010 Subaru forester, used Subaru wrx sti white in Dubai, used Subaru impreza price, used Subaru impreza for sale, used Subaru for sale UAE, used Subaru wrx sti for sale in UAE, used Subaru brz for sale UAE, used Subaru wrx for sale UAE, used Subaru UAE, used Subaru forester for sale in Dubai, used Subaru wrx for sale in Dubai, used Subaru cars for sale in UAE.';
	}elseif($make == 'land rover'){
      $title='Used land rover for sale in UAE, used land rover Dubai, used land rover defender for sale in Dubai, used land rover for sale in Dubai, used land rover defender for sale in UAE, second hand defender for sale, used land rover defender 110 for sale, used range rover for sale, range rover used Dubai, used land rover price in Dubai.';
	}elseif($make == 'aston martin'){
      $title='Aston martin for sale Dubai, aston martin for sale, aston martin one 77 for sale Dubai, aston martin car price, used Aston martin db9 for sale, Aston martin db9 price, buy used Aston martin, second hand Aston martin db9, used aston martin db11 for sale, used aston martin vantage for sale, aston martin pre owned.';
	}elseif($make == 'buick'){
      $title='Buick cars for sale, buick used cars, used buick for sale under 10000, used buick enclave for sale, buick enclave used cars, buick classic cars for sale, buick cars for sale online, used buick lacrosse 2016, buick rendezvous for sale, used buicks under 3000, used buicks under 5000, 2018 buick suv for sale.';
	}elseif($make == 'cadillac'){
      $title='Cadillac used cars for sale, cadillac used cars uae, old cadillacs for sale, used cadillac cts coupe for sale, certified used cadillac, used cadillac elr for sale, cadillac escalade for sale in Dubai, cadillac car price, cadillac uae price, pre owned cadillac, cadillac used car dealers.';
	 }elseif($make == 'chery'){
      $title='Used chery cars for sale, used chery cars for sale in uae, chery cars Dubai, chery cars for sale, chery cars price in uae, used chery tiggo for sale, chery used cars uae, chery qq used cars for sale, chery used cars, chery car dealer in Dubai, chery car price Dubai.';
	}elseif($make == 'chrysler'){
      $title='Chrysler used cars for sale, used chrysler 300 for sale, used chrysler 300 for sale in uae, used chrysler 200 for sale, used crossfire for sale, 2017 chrysler 300 srt8 for sale, 2012 chrysler 300 for sale, used chrysler 300 srt8 for sale, buy used chrysler 300, 300 chrysler 1970 for sale, chrysler 300 price uae.';
	}elseif($make == 'brilliance'){
      $title='Brilliance used car for sale, brilliance car uae, brilliance used cars, brilliance used cars in uae, brilliance car review, brilliance car price, brilliance car dealer in uae, brilliance car dealer dubai.';
	}elseif($make == 'daewoo'){
      $title='Daewoo used cars for sale, used daewoo cars for sale, used daewoo matiz for sale, used daewoo kalos cars for sale, used daewoo matiz cars for sale, daewoo cielo used cars for sale, used daewoo lanos cars for sale, used daewoo matiz, daewoo cars for sale, daewoo matiz for sale, daewoo musso for sale.';
	}elseif($make == 'dodge'){
      $title='Used dodge charger for sale, dodge charger for sale in uae, dodge charger for sale in Dubai, dodge charger second hand, dodge charger price in Dubai, used dodge charger price in uae, used 2019 dodge ram for sale, 2005 dodge challenger for sale, used dodge durango citadel, dodge challenger price in Dubai, dodge charger price in uae, dodge challenger for sale Dubai, buy used challenger.';
	}elseif($make == 'fiat'){
      $title='Fiat cars for sale, fiat car sale in uae, fiat used cars dubai, old fiat cars for sale, fiat cars in uae, fiat pre owned cars dubai, fiat 500 for sale uae, new fiat cars for sale, fiat cars price in uae, fiat cars in dubai, fiat car uae price, fiat 500 price.';
	}elseif($make == 'smart'){
      $title='Used smart car for sale, smart car for sale in uae, smart car price in uae, buy used smart car, used smart for sale, small smart cars for sale, second hand smart car, used smart cars for sale by owner, 2nd hand smart car, pre owned smart car, smart car price used, smart car for sale.';
	}elseif($make == 'daihatsu'){
      $title='Used daihatsu cars for sale, used daihatsu for sale, daihatsu sirion used cars, used daihatsu terios for sale, daihatsu cars for sale, daihatsu sirion for sale, used daihatsu terios for sale in uae, used daihatsu sirion for sale in uae, daihatsu terios used cars for sale, daihatsu terios second hand, daihatsu sirion for sale in uae, daihatsu terios for sale in dubai.';
	}elseif($make == 'ford'){
      $title='Used ford mustang, used ford fusion cars for sale, ford pre owned, ford mustang 2017, ford mustang 2015, used ford mustang for sale in dubai, used mustangs for sale, ford mustang price in dubai, ford used cars dubai, ford edge for sale in uae, ford edge for sale in dubai, ford second hand.';
	}elseif($make == 'geely'){
      $title='Geely used cars in uae, used geely for sale, used geely cars for sale in uae, used geely cars for sale, used geely cars, new geely cars for sale, geely car price in uae, geely emgrand 7 for sale, geely rolls royce for sale, geely emgrand for sale, geely cars uae, geely cars uae.';
	}elseif($make == 'gmc'){
      $title='Gmc cars in dubai, gmc used cars dubai, gmc cars for sale in dubai, gmc car price in dubai, gmc sierra used cars in dubai, gmc sierra for sale dubai, gmc pre owned dubai, gmc used cars in dubai, gmc cars dubai price, gmc pre owned cars dubai, used gmc cars for sale in dubai.';
	}elseif($make == 'honda'){
      $title='Honda used cars dubai, used honda accord for sale in dubai, honda civic for sale, honda used cars for sale, honda civic used cars, honda civic second hand, honda city used car, honda second hand cars, honda crv second hand, honda civic price in uae, used honda civic for sale under 5000, used honda cars in dubai.';
	}elseif($make == 'porsche'){
      $title='Used porsche dubai, porsche pre owned dubai, porsche cayenne for sale dubai, porsche used cars dubai, second hand porsche dubai, porsche for sale dubai, used porsche for sale in dubai, porsche 911 for sale dubai, used porsche cayenne dubai, porsche panamera price in dubai, porsche cayenne used dubai.';
	}elseif($make == 'tesla'){
      $title='Used tesla cars for sale in uae, used tesla for sale uae, tesla used cars in dubai, used tesla cars price in dubai, tesla used car dubai, tesla car price, tesla roadster, tesla electric car in Dubai, tesla car models, tesla motors used cars dubai, used tesla for sale in dubai, tesla roadster 2020 price.';
    }else{
      $title='Used cars in Dubai, used cars for sale in dubai, used cars for sale in uae, used cars in uae, second hand cars in dubai, used cars for sale, cars for sale in dubai, buy used cars dubai, used car price in uae, second hand cars in uae, used cars for sale in sharjah.';
    }

    return $title;

  }

  function getMetakeywords(){
    $ct1=$this->uri->rsegment(1);
    $ct2=$this->uri->rsegment(2);
    
    $title='';

    switch($ct1){
      case 'home':
				$title='Used cars for sale in uae, cars for sale in Dubai, used cars in Dubai, used cars for sale in Dubai, used bikes for sale in Dubai, buy used cars Dubai, used car price in uae, used boats for sale Dubai, old cars for sale, Dubai number plate for sale, second hand cars in Dubai, used cars in Dubai below 10000.';
      break;
      case 'cars':
        $title = $this->getKeywordsForCars();
				//$title='Used cars for sale in Dubai, used cars in Dubai, second hand cars in Dubai, buy used cars Dubai, used cars in Dubai for sale by owner, buy second hand car Dubai, used car prices in Dubai, sell used car Dubai, buy and sell cars in Dubai, best used car dealers in Dubai, best used car in Dubai, cheap second hand cars in Dubai, second hand cars for sale.';
      break; 
      case 'cardetails':
				$title='Auto Traders, used cars for sale, used cars, luxury cars for sale, luxury cars, dubai cars, dubai luxury cars';
      break; 
      case 'numberplates':
				$title='Dubai number plates for sale, number plates for sale, car number plates for sale, rta number plates for sale, used number plates for sale, 786 number plate for sale, Dubai car number plates for sale, VIP number plate for sale, Dubai car plates for sale, funny number plates for sale, Dubai 3 digit number plate for sale, umm al Quwain car number plates, motorbike number plates for sale.';
      break;  
      case 'boats':
				$title='Boats for sale Dubai, used boats for sale in Dubai, yacht for sale in Dubai, fishing boats Dubai, boats for sale Abu Dhabi, boat price Dubai, used boats Dubai, Dubai boat for sale, Dubai used boats for sale, used fishing boats for sale in Dubai, used boats for sale in UAE, cheap used boats for sale in Dubai, used passenger boats for sale in Dubai.';
      break; 
      case 'bikes':
				$title='Used bikes for sale in Dubai, Honda bikes Dubai, new bikes for sale in Dubai, brand new bikes for sale in Dubai, used motorbikes for sale in Dubai, Sharjah used bike market, Yamaha bikes UAE, Honda unicorn bike price in Dubai, used scooter for sale in Dubai, second hand motorcycle in Dubai, used motorbikes in Dubai, used motorbikes for sale in Dubai.';
      break;  
      case 'mobilenumbers':
				$title='vip mobile number,fancy mobile number';
      break;
      case 'dealer':
				$title='Car dealerships, dubai car dealers';
      break;  
      case 'dealers':
				$title='Car dealers in Dubai, used car dealers in Dubai, best car dealers in Dubai, best used car dealers in Dubai, new cars dealer Dubai, car dealers in Dubai used cars, best car deals Dubai, top car dealers in Dubai, car dealers in Dubai used cars, car dealers in UAE, best second hand car dealers in Dubai, online car dealers in Dubai, bmw car dealer Dubai, car deals Dubai, ford car dealer Dubai, Audi car dealer Dubai, mercedes dealer Dubai.';
      break;  
      case 'about':
				$title='Auto Traders, used cars for sale, used cars, luxury cars for sale, luxury cars, dubai cars, dubai luxury cars';
      break;   
      case 'contact':
				$title='Auto Traders, used cars for sale, used cars, luxury cars for sale, luxury cars, dubai cars, dubai luxury cars';
      break;
      case 'terms':
				$title='Auto Traders, used cars for sale, used cars, luxury cars for sale, luxury cars, dubai cars, dubai luxury cars';
      break;    
        
    }
    echo $title;
    
  }





}
?>