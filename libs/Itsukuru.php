<?php
/**
 * itsuku.ru
 *
 * @author  Yoichi Fujimoto <wozozo@nequal.jp>
 * @author  Keisuke Sato <riaf@nequal.jp>
 **/
class Itsukuru extends Flow
{
    /**
     * インデックスページ
     **/
    public function index() {
        $this->sessions('from_index', true);
    }

    /**
     * ブックマーク用画面
     *
     * @request string $saddr
     * @request string $daddr
     **/
    public function bookmark() {
        Log::debug($this->ar_sessions());
        if (!$this->is_vars('saddr') || !$this->is_vars('daddr')) {
            $this->redirect_by_map('index');
        }
        if (!$this->is_sessions('from_index') || $this->in_sessions('from_index') !== true) {
            $this->translate($this->in_vars('saddr'), $this->in_vars('daddr'));
        }
        $this->sessions('from_index', false);
    }

    /**
     * Google に転送する
     *
     * @param string $saddr
     * @param string $daddr
     **/
    private function translate($saddr, $daddr) {
        $url = 'http://www.google.co.jp/transit?'. http_build_query(array(
            'saddr' => mb_convert_encoding($saddr, 'SJIS-win'),
            'daddr' => mb_convert_encoding($daddr, 'SJIS-win'),
            'time' => date('Hi'),
            'ttype' => 'dep',
            'ie' => 'SJS',
            'output' => 'chtml',
            'f' => 'd',
            'dirmode' => 'transmit',
            'num' => 10,
            'btnG' => '%8F%E6%8A%B7%8C%9F%8D%F5', // "乗換検索"
        ));
        Http::redirect($url);
    }
}

