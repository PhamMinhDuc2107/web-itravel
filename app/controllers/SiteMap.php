<?php

class SiteMap extends Controller
{
    public $TourModel;
    public $HotelModel;
    public $CategoryModel;
    public $BlogModel;
    public $LocationModel;
    public function __construct() {
        $this->TourModel = $this->model("TourModel");
        $this->HotelModel = $this->model("HotelModel");
        $this->CategoryModel = $this->model("CategoryModel");
        $this->BlogModel = $this->model("BlogModel");
        $this->LocationModel = $this->model("LocationModel");
    }
    public function index() {
        header('Content-Type: application/xml; charset=utf-8');
        echo $this->generateSiteMap();
    }

    public function generateSiteMap() {
        $tours = $this->TourModel->all();
        $hotels = $this->HotelModel->all();
        $categories = $this->CategoryModel->all();
        $blogs = $this->BlogModel->all();
        $destinations = $this->LocationModel->where(['is_destination' => 1]);

        $baseUrl = _WEB_ROOT;
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $pages = [
            ['loc' => $baseUrl . '/gioi-thieu', 'priority' => '1.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/tin-tuc', 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/lien-he', 'priority' => '1.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/du-lich', 'priority' => '8.0', 'changefreq' => 'weekly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/visa', 'priority' => '6.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/ho-chieu', 'priority' => '6.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/thue-xe-du-lich', 'priority' => '6.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')], 
            ['loc' => $baseUrl . '/to-chuc-su-kien', 'priority' => '6.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
            ['loc' => $baseUrl . '/can-cuoc-cong-dan', 'priority' => '6.0', 'changefreq' => 'monthly', 'lastmod' => date('Y-m-d')],
        ];

        foreach ($pages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($page['loc']) . '</loc>';
            $xml .= '<lastmod>' . $page['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $page['priority'] . '</priority>';
            $xml .= '</url>';
        }

        foreach ($tours as $tour) {
            $lastmod = isset($tour['updated_at']) ? date('Y-m-d', strtotime($tour['updated_at'])) : date('Y-m-d');
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($baseUrl . '/du-lich/' . $tour['slug']) . '</loc>';
            $xml .= '<lastmod>' . $lastmod . '</lastmod>';
            $xml .= '<changefreq>daily</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        foreach ($hotels as $hotel) {
            $lastmod = isset($hotel['updated_at']) ? date('Y-m-d', strtotime($hotel['updated_at'])) : date('Y-m-d');
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($baseUrl . '/khach-san/' . $hotel['slug']) . '</loc>';
            $xml .= '<lastmod>' . $lastmod . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        foreach ($categories as $cate) {
            if ($cate['slug'] == 'dich-vu-khac') continue;

            $lastmod = isset($cate['updated_at']) ? date('Y-m-d', strtotime($cate['updated_at'])) : date('Y-m-d');

            if ($cate['slug'] == 'tour-trong-nuoc' || $cate['slug'] == 'tour-nuoc-ngoai' ||
                $cate['slug'] == 'tour-combo-gia-re' || $cate['slug'] == 'tour-cao-cap')
            {
                $url = $baseUrl . '/' . $cate['slug'];
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
                $xml .= '<lastmod>' . $lastmod . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.6</priority>';
                $xml .= '</url>';

                foreach ($destinations as $destination) {
                    if($destination['category'] === $cate['id']) {
                        $urlWithDest = $url . '?destination=' . urlencode($destination['slug']);
                        $xml .= '<url>';
                        $xml .= '<loc>' . htmlspecialchars($urlWithDest) . '</loc>';
                        $xml .= '<lastmod>' . $lastmod . '</lastmod>';
                        $xml .= '<changefreq>weekly</changefreq>';
                        $xml .= '<priority>0.6</priority>';
                        $xml .= '</url>';
                    }
                }
            }
        }

        foreach ($blogs as $blog) {
            $lastmod = isset($blog['updated_at']) ? date('Y-m-d', strtotime($blog['updated_at'])) : date('Y-m-d');
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($baseUrl . '/tin-tuc/' . $blog['slug']) . '</loc>';
            $xml .= '<lastmod>' . $lastmod . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.5</priority>';
            $xml .= '</url>';
        }



        $xml .= '</urlset>';

        return $xml;

    }

}