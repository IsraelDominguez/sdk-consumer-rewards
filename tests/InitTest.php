<?php namespace ConsumerRewards\SDK;

use Cache\Adapter\Void\VoidCachePool;
use PHPUnit\Framework\TestCase;

abstract class InitTest extends TestCase
{

    // Test Pernod
/*    protected $username = "929363639337055";
    protected $password = "Rsr2uCgSTiD00ty8wG3gHmOWc06I1E";
    protected $api = "https://api-consumerrewards-test.pernod-ricard-espana.com";
    protected $web = "https://consumerrewards-test.pernod-ricard-espana.com";*/

//  protected $qr_redeem ='000966218f0f509451260f9493b6cffecc050581fb314179871fcf26a8f54a97';
    // Test Sevilla
    protected $username = "609975803614572";
    protected $password = "NIfbbB773AjEIaM8LAz4JuixR7XFZu";
    protected $api = "https://api.test.rewards.sevillafc.es";
    protected $web = "https://www.test.rewards.sevillafc.es";

    protected $qr_redeem = '97fdbe1b26bbbb3095595fd12f379483bc3fb05c26f4f671957cfd110ad2e462';
    protected $qr_valid = '8f2d14cf411afc3e1d832dad62e0b96ec62019303289715bdfe3b7ce8e129a86';
    protected $qr_to_redeem = '31ac463c666b11686362d0c098588510401704d069511aaed2f740bc97a454ec';

    /**
     * @var \ConsumerRewards\SDK\ConsumerRewards
     */
    public $sdk;

    public function setUp()
    {
        $this->sdk = new \ConsumerRewards\SDK\ConsumerRewards([
            'username' => $this->username,
            'password' => $this->password,
            'api' => $this->api,
            'web' => $this->web,
        ],[
            'cache' => new VoidCachePool()
        ]);
    }


}
