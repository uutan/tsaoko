<?php

/**
 * @version $Id: UtilHelper.php 4714 2013-01-29 15:11:37Z lonestone $
 */
class UtilHelper
{

    public static function Array2Options($name)
    {
        $options = array();
        if (!is_array($name))
        {
            foreach (Yii::app()->params[$name] as $sub)
            {
                $options[$sub] = $sub;
            }
        } else
        {
            foreach ($name as $sub)
            {
                $options[$sub] = $sub;
            }
        }
        return $options;
    }

    //时间格式化
    public static function sgmdate($dateformat, $timestamp = '', $format = 1)
    {
        if (empty($timestamp))
        {
            $timestamp = time();
        }
        $result = '';
        if ($format)
        {
            $time = time() - $timestamp;
            if ($time > 24 * 3600)
            {
                $result = gmdate($dateformat, $timestamp + 8 * 60 * 60);
            } elseif ($time > 3600)
            {
                $result = intval($time / 3600) . '小时前';
            } elseif ($time > 60)
            {
                $result = intval($time / 60) . '分钟前';
            } elseif ($time > 0)
            {
                $result = $time . '秒前';
            } else
            {
                $result = '刚刚';
            }
        } else
        {
            $result = gmdate($dateformat, $timestamp + 8 * 60 * 60);
        }
        return $result;
    }

    public static function formatBytes($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
        } elseif ($bytes >= 1048576)
        {
            $bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
        } elseif ($bytes >= 1024)
        {
            $bytes = round($bytes / 1024 * 100) / 100 . 'KB';
        } else
        {
            $bytes = $bytes . 'Bytes';
        }
        return $bytes;
    }

    public static function jsonString($str)
    {
        return preg_replace("/([\\\\\/'])/", '\\\$1', $str);
    }

    public static function getpage($url, $codename = 'UTF-8', $timeout = 20)
    {

        if (!strpos($url, '://'))
            return 'Invalid URI';
        $content = '';
        if (function_exists('curl_init'))
        {
            $handle = curl_init();
            $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
            curl_setopt($handle, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
//             curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($handle, CURLOPT_ENCODING, 'gzip');
            $content = curl_exec($handle);
            curl_close($handle);
        } elseif (function_exists('fsockopen'))
        {
            $urlinfo = parse_url($url);
            $host = $urlinfo['host'];
            $str = explode($host, $url);
            $uri = $str[1];
            unset($urlinfo, $str);
            $content = '';
            $fp = fsockopen($host, 80, $errno, $errstr, 30);
            if (!$fp)
            {
                $content = 'Can Not Open Socket...';
            } else
            {
                stream_set_timeout($fp, 10); //超时时间

                $out = "GET " . $uri . "/  HTTP/1.1\r\n";
                $out.= "Host: $host \r\n";
                $out.= "Accept: */*\r\n";
                $out.= "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.1)\r\n)";
                $out.= "Connection: Keep-Alive\r\n\r\n";
                fputs($fp, $out);
                while (!feof($fp))
                {
                    $status = stream_get_meta_data($fp);
                    //读取数据超时
                    if ($status['timed_out'])
                        break;
                    $content .= fgets($fp, 4069);
                }
                fclose($fp);
            }
        }
        if (empty($content))
            $content = false;
        $content = self::convertencoding($content, $codename);
        return $content;
    }

    /*     * 下载文件* */

    public static function getfile($url, $save_to, $referer = '')
    {
        if (!strpos($url, '://'))
            return 'Invalid URI';
        $content = '';
        if (function_exists('curl_init'))
        {
            $retry = 0;
            do
            {
                $handle = curl_init();
                $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
                if ($referer)
                {
                    curl_setopt($handle, CURLOPT_REFERER, $referer);
                }
                curl_setopt($handle, CURLOPT_USERAGENT, $user_agent);
                curl_setopt($handle, CURLOPT_URL, $url);
                curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
//                 curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($handle, CURLOPT_ENCODING, 'gzip');
                $content = curl_exec($handle);
                curl_close($handle);
                $retry += 1;
            } while ($retry < 4 && empty($content));
        } elseif (function_exists('fsockopen'))
        {
            $urlinfo = parse_url($url);
            $host = $urlinfo['host'];
            $str = explode($host, $url);
            $uri = $str[1];
            unset($urlinfo, $str);
            $content = '';
            $fp = fsockopen($host, 80, $errno, $errstr, 30);
            if (!$fp)
            {
                $content = 'Can Not Open Socket...';
            } else
            {
                stream_set_timeout($fp, 10); //超时时间

                $out = "GET " . $uri . "/  HTTP/1.1\r\n";
                $out.= "Host: $host \r\n";
                $out.= "Accept: */*\r\n";
                $out.= "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.1)\r\n)";
                $out.= "Connection: Keep-Alive\r\n\r\n";
                fputs($fp, $out);
                while (!feof($fp))
                {
                    $status = stream_get_meta_data($fp);
                    //读取数据超时
                    if ($status['timed_out'])
                        break;
                    $content .= fgets($fp, 4069);
                }
                fclose($fp);
            }
        }
        if (empty($content))
            return false;

        return @file_put_contents($save_to, $content);
    }

    public static function convertencoding($data, $to = 'UTF-8')
    {
        $encode_arr = array('UTF-8', 'GBK', 'GB2312', 'BIG5');
        $encoded = mb_detect_encoding($data, $encode_arr);
        $data = mb_convert_encoding($data, $to, $encoded);
        return $data;
    }

 
    /**
     * 测试相对路径的文件是否存在
     * @param string $relativepath 相对路径
     */
    static function is_file_exists($relativepath)
    {
        $path = realpath(Yii::app()->basePath . '/..' . $relativepath);
        if ($relativepath && file_exists($path) && is_file($path))
            return true;
        return false;
    }

    public static function sizecount($filesize)
    {
        if ($filesize >= 1073741824)
        {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
        } elseif ($filesize >= 1048576)
        {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
        } elseif ($filesize >= 1024)
        {
            $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
        } else
        {
            $filesize = $filesize . ' Bytes';
        }
        return $filesize;
    }

    public static function curl_redir_exec($ch, $debug = '')
    {
        static $curl_loops = 0;
        static $curl_max_loops = 20;

        if ($curl_loops++ >= $curl_max_loops)
        {
            $curl_loops = 0;
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        $header = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code == 301 || $http_code == 302)
        {
            $matches = array();
            preg_match('/Location:(.*?)\n/', $header, $matches);
            $url = @parse_url(trim(array_pop($matches)));
            // print_r($url);
            if (!$url)
            {
                // couldn't process the url to redirect to
                $curl_loops = 0;
                return $data;
            }
            $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
            /*
             * if (!$url['scheme']) $url['scheme'] = $last_url['scheme']; if
             * (!$url['host']) $url['host'] = $last_url['host']; if
             * (!$url['path']) $url['path'] = $last_url['path'];
             */
            $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] .
                    ($url['query'] ? '?' . $url['query'] : '');
            curl_setopt($ch, CURLOPT_URL, $new_url);
            // debug('Redirecting to', $new_url);

            return self::curl_redir_exec($ch);
        } else
        {
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_NOBODY, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $curl_loops = 0;
            return $data;
        }
    }

    /**
     * 获取远程图片的宽高和体积大小
     *
     * @param string $url 远程图片的链接
     * @param string $type 获取远程图片资源的方式, 默认为 curl 可选 fread
     * @param boolean $isGetFilesize 是否获取远程图片的体积大小, 默认false不获取, 设置为 true 时 $type 将强制为 fread
     * @return false|array
     */
    public static function getImageSize($url)
    {
        $retry = 0;
        do
        {
            $result = self::tryGetImageSize($url);
            $retry++;
        } while ($retry <= 3 && $result['width'] == 0); //自动重试

        return $result;
    }

    public static function tryGetImageSize($url)
    {
        if (!function_exists('curl_init'))
        {
            // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法
            $handle = fopen($url, 'rb');

            if (!$handle)
                return false;

            // 只取头部固定长度168字节数据
            $dataBlock = fread($handle, 168);
        }
        else
        {
            // 据说 CURL 能缓存DNS 效率比 socket 高
            $ch = curl_init($url);
            // 超时设置
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值
            curl_setopt($ch, CURLOPT_RANGE, '0-168');
            // 跟踪301跳转
//             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // 返回结果
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $dataBlock = curl_exec($ch);

            curl_close($ch);

            if (!$dataBlock)
                return false;
        }

        // 将读取的图片信息转化为图片路径并获取图片信息,经测试,这里的转化设置 jpeg 对获取png,gif的信息没有影响,无须分别设置
        // 有些图片虽然可以在浏览器查看但实际已被损坏可能无法解析信息
        $size = getimagesize('data://image/jpeg;base64,' . base64_encode($dataBlock));
        if (empty($size))
        {
            return false;
        }

        $result['width'] = $size[0];
        $result['height'] = $size[1];

        if ($type == 'fread')
            fclose($handle);

        return $result;
    }

}