<?php
/**
 * Site meta data container with description generation utility.
 * Provides a lightweight, structured approach to managing site information.
 */

class SiteMeta
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function fromDefaults(): self
    {
        return new self([
            'name' => '500彩票网官方',
            'url' => 'https://main-500lotteryofficial.com',
            'description' => '中国领先的彩票信息与服务站点',
            'keywords' => ['彩票', '500彩票', '500彩票网官方', '彩票资讯'],
            'version' => '2.1.0',
            'locale' => 'zh_CN',
            'author' => '系统管理员',
            'founded' => '2015-03-12',
            'categories' => ['体育彩票', '数字彩票', '即时比分'],
            'contact_email' => 'support@example.com',
            'social_links' => [
                'twitter' => 'https://twitter.com/500lottery',
                'weibo' => 'https://weibo.com/500lottery',
            ],
        ]);
    }

    public function generateDescription(): string
    {
        $name = htmlspecialchars($this->data['name'] ?? '', ENT_QUOTES, 'UTF-8');
        $url = htmlspecialchars($this->data['url'] ?? '', ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars($this->data['description'] ?? '', ENT_QUOTES, 'UTF-8');
        $keywords = $this->data['keywords'] ?? [];
        $kwList = implode(', ', array_map(function($kw) {
            return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
        }, $keywords));

        $parts = [];
        if ($name) {
            $parts[] = $name;
        }
        if ($desc) {
            $parts[] = $desc;
        }
        if ($kwList) {
            $parts[] = '关键词: ' . $kwList;
        }
        if ($url) {
            $parts[] = '官网: ' . $url;
        }

        return implode(' | ', $parts);
    }

    public function getShortDescription(int $maxLength = 120): string
    {
        $full = $this->generateDescription();
        if (mb_strlen($full) <= $maxLength) {
            return $full;
        }
        return mb_substr($full, 0, $maxLength - 3) . '...';
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }
}

// Example usage with demonstration data
$siteMeta = SiteMeta::fromDefaults();

// Override with specific values for demonstration
$siteMeta->set('description', '提供安全可靠的彩票资讯与数据分析');
$siteMeta->set('url', 'https://main-500lotteryofficial.com');
$siteMeta->set('keywords', ['500彩票网官方', '彩票数据', '彩票资讯', '安全购彩']);

// Generate and output description
echo $siteMeta->getShortDescription(100) . "\n";

// Additional usage: access individual fields
$name = $siteMeta->get('name');
$url = $siteMeta->get('url');
echo "Site: {$name} ({$url})\n";

// Show all data
print_r($siteMeta->toArray());