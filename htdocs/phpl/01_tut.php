<?php
    echo "Hello World!<br>";
    $name = "Aman";
    echo "The name of the person is : $name<br>";
    echo var_dump($name)."<br>";
    $arr = array(1,2,3,4);
    echo "The array is : ";
    echo var_dump($arr)."<br>";
    echo "Array iteration using for loop is : ";
    for ($i=0; $i < count($arr); $i++) { 
        echo $arr[$i]." ";
    }
    echo "<br>";
    $arr1 = array("Aman", "Harry", 24, 30);
    echo "Array iteration using forEach loop is : ";
    foreach($arr1 as $val){
        echo $val." ";
    }
    echo "<br>";
    $bool1 = true;
    $bool2 = false;
    echo var_dump($bool1).var_dump($bool2)."<br>";
    echo "$bool1 and $bool2 <br>";  //Here for bool2 = false it will not show 0 rather it will show blankspace;
    $var1 = "Hey there! How are you";
    echo "$var1<br>";
    echo "The no of words in this sentence is : ".str_word_count($var1)."<br>";;
    echo "Reversed string of above string is : ".strrev($var1)."<br>";

    function greeting($var){
        echo "Good Morning!! $var<br>";
    }

    greeting("Jarvis");

    function calculate($a, $b){
        return $a+$b;
    }
    $c = calculate(34,6);
    echo "The result of this calculation is : ".$c."<br>";

    //Associative Arrays
    $arr2 = array("aman"=>"Chole-Bhature", "mini" => "Pani-Puri", "Hulk" => "Gamma", 42 => "Mark Iron Man Suit");
    foreach($arr2 as $key => $val){
        echo "The key is $key and the value corresponding to this key is $val<br>";
    }

    //Multi-Dimensional Array
    $arr3 = array(array(12, 1, 2, 3),
                  array(10, 11),
                  array(20, 21, 22),
                  array(30, 31, 32, 33));
    for ($i=0; $i < count($arr3) ; $i++) { 
        for ($j=0; $j < count($arr3[$i]); $j++) { 
            echo $arr3[$i][$j];
            echo " ";
        }
        echo "<br>";
    }
    

?>