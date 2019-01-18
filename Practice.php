<?php

// 创建一个函数,该函数接受一个字符串并返回一个新字符串,并交换其第一个和最后一个字符,以下三个条件除外:
// 如果字符串的长度小于2,则返回Incompatible
// 如果参数不是字符串,则返回uncompatible
// 如果第一个和最后一个字符相同,则返回Two's a pair
// function flipEndChars($str)
// {
//     if (gettype($str) != "string") {
//         return "uncompatible.";
//     } elseif (strlen($str) < 2) {
//         return "Incompatible.";
//     } elseif (substr($str, 0, 1) == substr($str, -1)) {
//         return "Two's a pair.";
//     } else {
//         return substr($str, -1) . substr($str, 1, strlen($str)-2) . substr($str, 0, 1);
//     }
// }

// $a = 'Cat, dog, and mouse.';
// print_r(flipEndChars($a));



// 多个进程同时写入同一个文件成功
// 以读写并且清空的方式打开一个文件
// $fp = fopen("lock.txt", "w+");
// // 要取得独占锁定（写入的程序）
// if (flock($fp, LOCK_EX)) {
//     // 写入文件
//     fwrite($fp, 'xxxx');
//     // 要释放锁定（无论共享或独占）
//     flock($fp, LOCK_UN);
// } else {
//     echo '1111';
// }
// // 关闭文件
// fclose($fp);



// 从url中取出文件的扩展名 php
// function getExt($url) {
//     // 解析一个 URL 并返回一个关联数组，包含在 URL 中出现的各种组成部分
//     $arr = parse_url($url);
//     // 返回路径中的文件名部分。
//     $file = basename($arr['path']);
//     // 通过.拆分成数组
//     $ext = explode('.', $file);
//     // 返回数组最后一个元素
//     return $ext[count($ext)-1];
// }

// $path = 'http://www.sina.com.cn/abc/de/fg.php?id=1';
// echo getExt($path);



// 遍历文件夹下的所有文件和子文件夹
// function my_scandir($dir) {
//     $files = array();
//     // 检测$dir是否是目录
//     if (is_dir($dir)) {
//         // 打开目录
//         if ($handle = opendir($dir)) {
//             // 循环当前目录下的子目录
//             while (($file = readdir($handle)) !== false) {
//                 // 去掉.和..文件夹
//                 if ($file !== "." && $file !== "..") {
//                     // 检测子目录是否是目录
//                     if (is_dir($dir . '/' . $file)) {
//                         // 是目录再次调用my_scandir函数
//                         $files[$file] = my_scandir($dir . '/' . $file);
//                     } else {
//                         $files[] = $dir . '/' . $file;
//                     }
//                 }
//             }
//             // 关闭目录
//             closedir($handle);
//             return $files;
//         }
//     }
// }

// $path = 'C:\Users\Administrator\Desktop\aaaaa';
// print_r(my_scandir($path));




// 算出两个文件夹的相对路径
// function path($path1, $path2) {
//     // 获取目录名并拆分成数组
//     $arr1 = explode('/', dirname($path1));
//     $arr2 = explode('/', dirname($path2));
//     // 计算出有几个相同目录
//     for ($i = 0, $len = count($arr2); $i < $len; $i++) {
//         if ($arr1[$i] != $arr2[$i]) {
//             break;
//         }
//     }
//     // 不在同一个根目录下
//     if ($i == 0) {
//         $return = array_fill(0, $len, '..');
//     }
//     // 在同一个根目录下
//     if ($i != 0 && $i < $len) {
//         // 用值填充数组
//         $return = array_fill(0, $len - $i, '..');
//     }
//     // 在同一个目录下
//     if ($i == $len) {
//         $return = array('./');
//     }
//     // 拆分出不同的目录然后拼接成一个数组
//     $return = array_merge($return, array_splice($arr1, $i));
//     // 数组拼接成字符串
//     return implode('/', $return);
// }

// $a = '/a/b/c/d/e.php';
// $b = '/a/b/12/34/c.php';
// echo path($a, $b);



// 创建一个函数，该函数接受一个数字并返回一个字符串，其中包含扩展表示法中的数字（AKA扩展形式）。有关扩展表示法的详细信息，请参阅资源选项卡。
// function text($str) {
//     $arr = str_split($str);
//     $data = array();
//     foreach($arr as $k=>$v) {
//         $data[] = $v * pow(10, count($arr) - $k - 1);
//     }
//     $data = array_filter($data, function($item) {
//         return $item > 0;
//     });
//     return implode('+', $data);
// }

// $a = 5321;
// print_r(text($a));



// 冒泡排序
// function text($arr) {
//     for($i=0;$i<count($arr)-1;$i++) {
//         for($k=0;$k<count($arr)-1-$i;$k++) {
//             if($arr[$k]>$arr[$k+1]) {
//                 $qq = $arr[$k];
//                 $arr[$k] = $arr[$k+1];
//                 $arr[$k+1] = $qq;
//             }
//         }
//     }
//     return $aa;
// }

// $a = [1,3,2,5];
// print_r(text($a));




// 快速排序
// function quickSort($arr)
// {
//     if (count($arr) <= 1) return $arr;
//     $index = (int)floor(count($arr) / 2);
//     $value = $arr[$index];
//     array_splice($arr, $index, 1);
//     $left = $right = [];
//     for ($i = 0; $i < count($arr); $i++) {
//         if ($arr[$i] < $value) {
//             array_push($left, $arr[$i]);
//         } else {
//             array_push($right, $arr[$i]);
//         }
//     }
//     $left = quickSort($left);
//     $right = quickSort($right);
//     array_push($left, $value);
//     return array_merge($left, $right);
// }
// $a = [4,5,2,1,3];
// print_r(quickSort($a));



// 返回首写大写字母
// function capMe($arr) {
//     return array_map('ucfirst', array_map('strtolower', $arr));
// }

// $a = ['aa', 'BB', 'cc'];
// print_r(capMe($a));