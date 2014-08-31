<?php

// $Id: 090619 Helper_Modifier kth007@gmail.com $

/**
 * 字符串处理助手
 */
class ModifierHelper
{

    static function alipayText($msg)
    {
        $msg = trim(htmlspecialchars(stripslashes($msg)));
        $msg = str_replace(' ', '', $msg);
        $msg = str_replace('+', '', $msg);
        $msg = str_replace('%40', '', $msg);
        return addslashes($msg);
    }

    /**
     * 得到指定年月的总天数
     * 
     * php 内置cal_days_in_month有的服务器无法执行
     * 
     * @param unknown_type $year
     * @param unknown_type $month
     * @return number
     */
    static function day_num($year, $month)
    {
        $time = strtotime($year . '-' . $month . '-1');
        return date('t', $time);
    }

    /**
     * 中文截取，单字节截取模式
     * 一个中文=两个英文
     * 
     * @param string $str
     * @param int $slen=50
     * @param string $dot=''
     * @return string
     */
    static function left($str, $slen = 50, $dot = '...')
    {
        include_once (dirname(__FILE__) . '/modifier/cnsubstr.php');
        if (strtolower(Yii::app()->charset) == 'utf-8')
        {
            return cn_substr($str, $slen, true, $dot);
        } else
        {
            return cn_substr($str, $slen, false, $dot);
        }
    }

    /**
     * HTML 转 文本
     * 第二个参数为是否转意。默认不转意
     * @param string $str
     * @param bool $r
     * @return string
     */
    static function Html2Text($str, $r = 0)
    {
        include_once (dirname(__FILE__) . '/modifier/htmltext.php');
        if ($r == 0)
        {
            return Html2Text($str);
        } else
        {
            return addslashes(Html2Text(stripslashes($str)));
        }
    }

    /**
     * 文本转HTML
     *
     * @param string $txt
     * @return string
     */
    static function Text2Html($txt)
    {
        include_once (dirname(__FILE__) . '/modifier/htmltext.php');
        return Text2Html($txt);
    }

    /**
     * 处理禁用HTML但允许换行的内容
     *
     * @param string $msg
     * @return string
     */
    function TrimMsg($msg)
    {
        $msg = trim(stripslashes($msg));
        $msg = nl2br(htmlspecialchars($msg));
        $msg = str_replace("  ", "&nbsp;&nbsp;", $msg);
        return addslashes($msg);
    }

    /**
     * 当无数据时的默认值
     *
     * @param string $string
     * @param string $default
     * @return string
     */
    function DefaultTEXT($string, $default = '')
    {
        if (!isset($string) || $string === '')
            return $default;
        else
            return $string;
    }

    /**
     * 格式化时间
     * 
     * @param string $format
     * @param boot $timest=0
     * @return unknown
     */
    static function MyDate($format = 'Y-m-d H:i:s', $timest = 0)
    {
        if (!$timest)
        {
            $timest = time();
        }
        if (empty($format))
        {
            $format = 'Y-m-d H:i:s';
        }
        return date($format, $timest);
    }

    /**
     * 计算时间差
     * @param $begin_time
     * @param $end_time
     * @return array
     */
    static function timeDiff($begin_time, $end_time)
    {
        if ($begin_time < $end_time)
        {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else
        {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        $timediff = $endtime - $starttime;
        $days = intval($timediff / 86400);
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        $secs = $remain % 60;
        $res = array("day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs);
        return $res;
    }

    /**
     * 把全角数字或英文单词转为半角
     *
     * @param string $fnum
     * @return string
     */
    static function GetAlabNum($fnum)
    {
        $nums = array("０", "１", "２", "３", "４", "５", "６", "７", "８", "９", "＋", "－", "％", "．", "ａ", "ｂ", "ｃ", "ｄ", "ｅ", "ｆ", "ｇ", "ｈ", "ｉ", "ｊ", "ｋ", "ｌ", "ｍ", "ｎ", "ｏ", "ｐ", "ｑ", "ｒ", "ｓ ", "ｔ", "ｕ", "ｖ", "ｗ", "ｘ", "ｙ", "ｚ", "Ａ", "Ｂ", "Ｃ", "Ｄ", "Ｅ", "Ｆ", "Ｇ", "Ｈ", "Ｉ", "Ｊ", "Ｋ", "Ｌ", "Ｍ", "Ｎ", "Ｏ", "Ｐ", "Ｑ", "Ｒ", "Ｓ", "Ｔ", "Ｕ", "Ｖ", "Ｗ", "Ｘ", "Ｙ", "Ｚ");
        $fnums = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+", "-", "%", ".", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $fnum = str_replace($nums, $fnums, $fnum);
        return $fnum;
    }

    /**
     * 过滤脏字
     * 第二个参数为缓存时间
     * @param string $data
     * @param int $time=86400
     * @return string
     */
    static function FilterWord($data = '', $time = 86400)
    {
        $QCache = new QCache_File(array('life_time' => $time));

        $FilterWord = $QCache->get('FilterWord_cache');
        if (!$FilterWord)
        {
            $fp = fopen(dirname(__FILE__) . '/modifier/data/filterword.dat', 'r');
            while (!feof($fp))
            {
                $line = fgets($fp);
                $word_tmp = array_map('trim', explode("=", $line));
                if (count($word_tmp) == 2)
                {
                    $FilterWord ['word_one'] [] = '/' . str_replace('*', '.*', $word_tmp [0]) . '/';
                    $FilterWord ['word_two'] [] = $word_tmp [1];
                }
            }
            fclose($fp);
            $QCache->set('FilterWord_cache', $FilterWord); //写入缓存
        }

        if (!is_array($FilterWord ['word_one']))
        {
            return $data;
        }
        return preg_replace($FilterWord ['word_one'], $FilterWord ['word_two'], $data);
    }

    /**
     * 获得拼音
     * 第二个参数为是否获取第一个字母，默认为拼音
     * 第二个参数为分隔符，默认为不分割
     *
     * @param string $str
     * @param bool $ishead=0
     * @param string $fenge=''
     * @return string
     */
    static function GetPinyin($str, $ishead = 0, $fenge = '')
    {
        if (strtolower(Yii::app()->charset) == 'utf-8')
        {
            $str = iconv('utf-8', 'gbk//ignore', $str);
        }
        include_once (dirname(__FILE__) . '/modifier/pinyin.php');
        $restr = Pinyin($str, $ishead, $fenge);
        if (strtolower(Yii::app()->charset) == 'utf-8')
        {
            $restr = iconv('gbk', 'utf-8//ignore', $restr);
        }
        return $restr;
    }

    /**
     * RMM分词
     * 第二个参数 识别数量词及人名，默认识别
     * 第三个参数 岐义处理 默认处理
     *
     * @param string $str
     * @param bool $tryNumName=true
     * @param bool $tryDiff=ture
     * @return string
     */
    static function SplitWord($str = '', $tryNumName = true, $tryDiff = true)
    {
        if (strtolower(Yii::app()->charset) == 'utf-8')
            $str = iconv('utf-8', 'gbk//ignore', $str);
        include_once (dirname(__FILE__) . '/modifier/splitword.php');
        $SplitWord = new SplitWord ();
        $SpWord = $SplitWord->SplitRMM(self::Html2Text($str), $tryNumName, $tryDiff);
        if (strtolower(Yii::app()->charset) == 'utf-8')
        {
            $SpWord = iconv('gbk', 'utf-8//ignore', $SpWord);
        }
        $SplitWord->Clear();
        return $SpWord;
    }

    /**
     * 除去字串中的重复词，生成索引字符串
     * 自动获得关键字
     * 第二个参数为长度 一般为50合适
     * 
     * @param string $str
     * @param int $ilen=-1
     * @return string
     */
    static function GetKeyword($str, $ilen = -1)
    {
        if (strtolower(Yii::app()->charset) == 'utf-8')
            $str = iconv('utf-8', 'gbk//ignore', $str);
        include_once (dirname(__FILE__) . '/modifier/splitword.php');
        $SplitWord = new SplitWord ();
        $IndexText = $SplitWord->GetIndexText(self::Html2Text($str), $ilen);
        if (strtolower(Yii::app()->charset) == 'utf-8')
        {
            $IndexText = iconv('gbk', 'utf-8//ignore', $IndexText);
        }
        $SplitWord->Clear();
        return $IndexText;
    }

    /**
     * 文章自动获得关键字
     * 第一个参数为标题
     * 第二个参数为内容
     * 第三个次数为长度
     * 第四个参数为分隔符
     * 说明：只适应文章类型的获取关键字
     *
     * @param string $title
     * @param string $body
     * @param int    $ilen=50
     * @param string $fenge=''
     * @return string
     */
    function ArcKeyword($title, $body, $ilen = 50, $fenge = ' ')
    {
        $keywords = "";
        $titleindexs = explode(' ', trim(self::GetKeyword($title)));
        $allindexs = explode(' ', trim(self::GetKeyword($body, $ilen)));
        if (is_array($allindexs) && is_array($titleindexs))
        {
            foreach ($titleindexs as $k)
            {
                if (strlen($keywords) >= $ilen)
                {
                    break;
                } else
                {
                    $keywords .= $keywords ? $fenge . $k : $k;
                }
            }
            foreach ($allindexs as $k)
            {
                if (strlen($keywords) >= $ilen)
                {
                    break;
                } else if (!in_array($k, $titleindexs))
                {
                    $keywords .= $keywords ? $fenge . $k : $k;
                }
            }
        }
        return $keywords = addslashes($keywords);
    }

}