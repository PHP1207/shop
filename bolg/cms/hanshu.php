<?php
$abs=abs(-4.2);//$abs求绝对值
echo ceil(9.999);//ceill向上取整
echo floor(9.999);//floor向下取整
//fmod();//浮点数取舍
$x=5.7;
$y=1.3;//两个浮点数x>y浮点余数
$r = fmod($x,$y);
echo pow(-1,20);//pow返回n次方//1基础数|n次方乘方值
echo round(1.95583,2);//浮点数四舍五人//1.96,一个数值|保留小数点后多少位,默认为0舍入后的结果
//sqrt()求平方根
echo sqrt(9);//3被开方的数平方根
//max()求最大值
echo max(1,3,5,6,7);//7对个数字或数组返回其中的最大值
echo max([4,6,8]);//8
//min():求最小值
//输入:多个数字或数组
//输出:返回其中的最小值
//mt_rand()更好的随机数
//输入:最小|最大,输出:随机数随机返回范围内的值
echo mt_rand(1,9);//n
//rand()随机数 输入:最小|最大, 输出:随机数随机返回范围内的值
//pi()获取圆周率值
//去空格或或其他字符:
//trim()删除字符串两端的空格或其他预定义字符
//rtrim()删除字符串右边的空格或其他预定义字符
//chop:rtrim的别名
//ltrim()删除字符串左边的空格或其他预定义字符串
//dirname()返回路径中的目录部分
//echo dirname();
//输入:一个包含路径的字符串返回值:返回文件路径的目录部分字符串生成与转换
//str_pad()把字符串填充为指定的长度
//输入要填充的字符串|新字符串|供填充使用的字符串,默认是空白
//输出:完成后的字符串
//str_repeat()重复使用指定字符串
echo str_repeat('.',13);//要重复的字符串|字符串将被重复的次数13个点
//str_split();把字符串分割到数组中
//print_r();输入:要分割的字符串|每个数组元素的长度,默认1
//输出:拆分后的字符串数组
//strrev();反转字符串
//输出:目标字符串颠倒顺序后的字符串
//wordwrap()按照指定长度对字符串进行折行处理
//输入:目标字符串|最大宽数
//输出:折行后的新字符串
//str_shuffle();随机地打乱字符串中所有字符
//输入:目标字符串顺序输出:打乱后的字符串
//parse_str()将字符串解析成变量
//输入要解析的字符串|储存变量的数组名称
//输出:返回Array([id]=>23[name]=>john Adams)
//number_format()通过千位分组来格式化数字输入:要格式化的数字|规定多少个小数|规定用作小数点的字符串|规定用作千位分隔符的字符串
//strtolower();字符串转为小写
//目标字符串 小写字符串
//strtoupper();输出:大写字符串
//ucfirst()字符串首字母大写
//ucwords()字符串每个单词首字符转为大写
//htmlentities();把字符转为html实体
//htmlspecialchars();预定义字符转html代码
//nl2br()\n转义为<br>标签
//输出:处理的字符
//strip_tags()剥去html xml 以及php的标签
//addcslashes()在指定的字符前添加反斜线转义字符串中的字符
//输入:目标字符串|指定的特殊字符或字符范围
//stripslashes()删除由addcslashes()添加的反斜线
//addslashes()指定预定义字符前添加反斜线
//输出:把目标串中的'"\和null进行转义处理
//quotemeta()在字符串中某些预定义的字符前添加反斜线
//chr()从指定的ASCII值返回字符
//ord()返回字符串第一个字符的ASCII值
//strcasecmp()不区分大小写比较两字符串
//输出:两个目标字符串输出:大1|等0|小-1
//strcmp()区分大小写比较两字符串
//strncmp()比较字符串前n字符,区分大小写
//调用int strncmp(string,$str1,string $str2 ,int $len);
//strncasecmp()比较字符串前n个字符,区分大小写
//调用:int strncasecmp()比较字符串前n个字符,不区分大小写
//strnatcmp()自然顺序法比较字符串长度,区分大小写
//调用:int strnatcmp(string $str1,string $str2)
//输入:目标字符串
//strnatcasecmp();自然顺序比较字符串长度,不区分大小写
//调用: int strnatcasecmp(string $str1,string $str2);
//chunk_split();将字符串分成小块
//调用:str chunk_split(str $body[,int $len[,str $end]]);
//输入:$boy 目标字串,$len长度,$str插入结束符 输出:分割后的字符串
//strtok()切开字符串
//调用:str strok(str $str ,str $token)
// 目标字符串$str,以$token为标志切割返回切割后的字符串
//explode()使用一个字符串为标志分割另一个字符串
//调用:array explode(str $sep,str $str[,int $limit])
//输入:$sep为分割符,$str目标字符串,$limit返回数组最多包含元素数 输出:字符串被分割后形成的数组
//implode()同join,将数组值用预订字符连接成字符串
//调用:string implode()
//$gule默认 ,用"则直接连接"
//substr()截取字符串
//调用:string substr()
//字符串查找替换
//str_replace()字符串替换操作,区分大小写
//调用mix str_replace
//输入:$search查找的字符串,$replace替换的字符串$subject被查找字符串,&$num输出:返回替换后的结果
//str_ireplace()字符串替换操作,不区分大小写
//输入:$search查找的字符串,$replace替换的字符串$subject被查找字符串,&$num输出:返回替换后的结果
//substr_count()统计一个字符串,在另一个字符串中出现次数
//调用:int substr_count()
//substr_replace()替换字符串中某串为另一个字符串
//similar_text()返回两字符串相同字符的数量
//调用:int similar_text();
//输入:两个比较的字符串
//输出:整形,相同字符数量
//strchr()返回一个字符串在另一个字符串中最后一次出现位置开始到末尾的字符串
//调用:string strchr()
//strstr()返回一个字符串在另一个字符串中开始位置到结束的字符串
//调用:string str();
//stristr()返回一个字符串在另一个字符串开始位置到结束的字符串,不区分大小写
//调用:string stristr
//strtr()转换字符串的某些字符
//调用:string strtr
//strpos()寻找字符串中某字符最先出现的位置,不区分大小写调用int stripos
//strrpos()寻找某字符串中某字符最后出现的位置
//调用:int strrpos
//strripos()寻找某字符串中某字符最后出现的位置,不区分大小写
//strspn();返回字符串中首次符合mask的子字符串长度调用:int strspn
//strspn()返回字符串中首次符合mask的字符串长度调用:int strspn()
//strcspn返回字符串中不符合mask的字符串的长度
//输入:$str1被查询$str2查询字符串$start开始查询的字符串
//str_word_count()统计字符串含有的单次数
//调用:mix str_word_count()
//输入:目标字符串输出:统计出的数量
//strlen()统计字符串长度 int strlen()
//输入:目标字符串 输出:统计处的数量
//count_chars():统计字符串中所有字母出现次数调用:mixed字符串编码
//md5()字符串md5编码
//array()生成一个数组
//数组值或键=>值一个数组型变量
//array_column()生成一个数组,用一个数组的值作为键名,另一个数组值作为值
//range()创建并返回一个包含指定范围的元素的数组
//输入:0是最小值,50是最大值10是步长输出:合成后的数组
//compact()创建一个由参数所带变量组成的数组
//变量或数组
//返回由变量名为键,变量值为值的数组,变量也可以为多维数组,会递归处理
//array_merge()把两个或多个数组合并为一个数组
//输入:两个数组输出:返回完成后的数组
//array_slice()在数组中根据条件取出一段值,并返回
//array_diff()返回两个数组的差集数组
//输入:两个或多个数组输出:$a1与$a2的不同之处
//array_intersect()返回两个或多个数组的交集数组
//array_search()在数组中查找一个值,返回一个键没有返回返回假
//输入:一个数组输出:成功返回键名,失败返回false
//array_splice()把数组中一部分删除用其他值替代
//输入:一个或多个数组 输出:$a1被移除的部分有$a2补全
//array_sum()返回数组中所有值的总和
//输入:一个数组输出:返回和
//in_array()在数组中搜索给定的值,区分大小写
//输入:徐亚搜索的值|数组 输出:true/false
//array_key_exists()判断某个数组中是否存在指定的key
//输入:需要搜索键名|数组
//数组指针操作
//key()返回数组内部指针当前指向元素的键名
//current()返回数组中的当前元素(单元)
//next()把指当前元素的指针移动到下一个元素的位置,并返回当前元素的值
//prev()把指向当前元素的指针移动到上一个元素的位置,并返回当前元素的值
//end()将数组内部指针指向最后一个元素,并返回该元素的值(如果成功)
//reset()把数组的内部指针向第一个元素,并返回这个元素的值
//list()用数组中的元素为一组变量赋值
//输入:$a,$b,$c为需要赋值的变量输出:变量分别匹配数组中的值
//array_shift()删除数组中的第一个元素,并返回被删除元素的值
//array_unshift()在数组开头插入一个或多个元素
//array_push()向数组最后压入一个或多个元素
//输入:目标数组|需要压入的值返回值:返回新的数组
//array_pop()取得(删除)数组中的最后一个元素
//shuffle()将数组打乱,保留键名
//输入:一个或多个数组输出:顺序打乱后的数组
//count()计算数组中的单元数目或对象中的属性个数
//输入:数组 输出:输出元素个数
//array_flip()返回一个键值反转后的数组
//输出:返回完成后的数组101.array_keys():返回数组所有的键,组成一个数组
//输出:返回由键名组成的数组
//array_values()返回数组中的所有值,组成一个数组
//输出:返回由键值组成的数组
//array_reverse()返回一个元素顺序相反的数组元素顺序相反的一个数组键名和键值依然匹配
//array_count_values()统计数组中所有的值出现的次数
//输出:返回数组原键值为新建名,次数为新建值
//array_rand()从数组中随机抽取一个或多个元素,注意是键名
//$a为目标数组,1为抽取第几个元素的键名返回第1个元素的键名b
//each()返回数组中当前的键/值对并将数组指针向前移动一步调用array each
//array_unique()删除重复值,返回剩余数组
//输入:数组 输入:返回无重复值数组,键名不变数组排序
//sort()按升序对给定数组的值排序,不保留键名
//fopen()打开文件或者URL
//返回值:如果打开失败,本函数返回false
//fclose()关闭一个已打开的文件指针
//输出:如果成功则返回true,失败则返回false文件属性
//file_exists()检查文件或目录是否存在
//调用:bool is_writable()
//输出:如果文件存在并且可写则返回true
//filectime()获取文件的创建时间
//filemtime()获取文件的修改时间
//输出:返回文件上次被修该的时间,出错时返回false
//fileatime()获取文件的上次访问时间
//输出:返回文件上次被访问的时间,如果出错则返回false
//stat()获取文件大部分属性值
//fwrite()写入文件
//fputs()同上
//fread()读取文件
//feof()检测文件指针是否到了文件结束的位置
//fgets()从文件指针中读取一行
//fgetc()从文件指针中读取字符
//file()把整个文件读入一个数组中
//readfile()输出一个文件
//file_get_contents()将整个文件读入一个字符串
//ftell()返回文件指针读/写的位置
//fseek()在文件指针中定位
//rewind()倒回文件指针的位置
//flock()轻便的执行文件锁定
//basename()返回路径中的文件名不分
//dirname()返回路径中的目录部分
//pathinfo()返回文件路径的信息
//opendir()打开目录句柄
//readdir()从目录句柄中读取条目
//closedir()关闭目录句柄
//rmdir()删除目录
//unlink()删除文件
//copy()拷贝文件
//rename()重命名一个文件或目录
//is_uploaded_file()判断文是否通过http post上传的
//move_uploaded_file()将上传的文件移动到新位值
//time()返回当前的时间戳
//mktime()取得一个日期的时间戳
//checkdate()验证一个格里高里日期
//date_default_timezone_set()设定用于一个脚本中所有日期时间函数的默认时区
//getdate()取得日期
//strtotime()将任何英文文本的日期时间描述解析为时间戳
//microtime()返回当前时间戳和微秒数
//intval()获取变量的整数值