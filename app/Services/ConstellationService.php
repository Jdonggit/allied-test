<?php

namespace App\Services;

use Yish\Generators\Foundation\Service\Service;

use App\Repositories\ConstellationRepository;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ConstellationService extends Service
{
    protected $repository;

    /**
     * 星座網址
     */
    protected $url = 'https://astro.click108.com.tw/';


    public function __construct(ConstellationRepository $constellationRepo)
    {
        $this->repository = $constellationRepo;
    }

    /**
     * 爬星座回來
     */
    public function get_constellation()
    {
        $all_data = array();

        $res = Http::get($this->url); 

        $crawler = new Crawler($res->body());
        $data = array();
        // 拿取星座
        $constellations = $crawler->filter('.STAR12_BOX li')->each(function (Crawler $node, $i) {
            $tmp['text'] = $node->text();
            $tmp['url'] = $node->filter('a')->attr('href'); 
            return $tmp;
        });
        
        foreach ($constellations as $key => $constellation) {
            $data[$key]['name'] =  $constellation['text'];
            $data[$key]['date'] =  date('Y-m-d');
            $data[$key]['created_at'] =  date('Y-m-d H:i:s');
            $explode_url = explode("=", $constellation['url']);
            $url = urldecode($explode_url[2]);
            
            $detail_res = Http::get($url); 

            $detail_crawler = new Crawler($detail_res->body());
            // 拿取星座詳細運勢
            $details = $detail_crawler->filter('.TODAY_CONTENT p')->each(function (Crawler $node, $i) {
                return $node->text();
            });
            
            $data[$key]['desc'] = json_encode($details, true);
            
        }
        // dd($data);
        $this->repository->insert($data);
    }
}
