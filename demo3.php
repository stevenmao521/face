<?php
/*
 * redis解决高并发抢够问题
 */
#常规做法
$redis = new Redis(array(
    'scheme'=>'tcp',
    'host'=>'127.0.0.1',
    'port'=>'6379'
));
$redis->auth('1234567');
#用户id
$user_id = $_SESSION['uid'];
#规定抢购库存
$nums = 10;

#订单长度
$len = $redis->llen("order:1");
if ($len >= $nums) {
    exit("抢完了");
}
#记录入库
$redis->lpush('order:1', $user_id);
exit("抢到");

#以上设计如果大并发时，当库存长度为9时，又同时并发3人进入则会绕过if判断
#出现超卖现象，所以这里需要使用redis的原子操作实现单线程
#redis列表的pop操作是原子性的,把库存单独存放于goods表中，进行lpop取操作
$check = $redis->lpop("goods:1");
if (!$check) {
    exit("抢完");
}

/*
 * redis锁机制解决并发问题，如果用户并发请求多次如果服务器没有加锁
 * 则用户可以多次请求成功
 * 例如：用户提交领取换领码，如果没有加锁，用户可以根据一张换领码同时领取多张优惠券
 */
if ($code) {
    #执行换领->在这一步同时并发多条进来，就会换领多次
    #更新为已领取
}
#如果使用文件锁，不能解决分布式架构的并发问题，所以这里采用redis
#采用redis的setnx (set it not exists)
#当键值不存在，插入成功获取锁成功，如果键值已存在，插入失败，获取锁失败
#setnx 设置key成功返回1，设置失败则返回0，设置成功表示获取锁成功

class RedisLock
{
    #redis配置文件
    protected $config;
    protected $redis;
    
    public function __construct($config) {
        $this->config = $config;
        #redis连接操作
        $this->redis = $this->connect($config);
    }
    
    #key 键值 expire过期时间
    public function lock($key, $expire) {
        $islock = $this->redis->setnx($key, time() + $expire);
        #超过锁生命周期删除锁
        #不能获取锁
        if (!$islock) {
            #过期时间
            $value = $this->redis->get($key);
            if (time() >= $value) {
                #删除锁，重新获取
                $this->unlock($key);
                $this->redis->setnx($key, time() + $expire);
            }
        }
        return $islock ? true : false;
    }
    #删除锁
    public function unlock($key) {
        $this->redis->del($key);
    }
}
$config = array(
    'host' => 'localhost',
    'port' => 6379,
    'index' => 0,
    'auth' => '',
    'timeout' => 1,
    'reserved' => NULL,
    'retry_interval' => 100,
);

// 创建redislock对象
$oRedisLock = new RedisLock($config);
// 定义锁标识
$key = 'mylock';
// 获取锁
$is_lock = $oRedisLock->lock($key, 10);
if($is_lock){
    echo 'get lock success<br>';
    echo 'do sth..<br>';
    sleep(5);
    echo 'success<br>';
    $oRedisLock->unlock($key);

// 获取锁失败
}else{
    echo 'request too frequently<br>';
}


/*
 * 大型B2C项目架构
 */
/*
 * 1.业务拆分(应用拆分为不同子系统)
 * 根据业务进行垂直切分，产品子系统，购物子系统，支付子系统,
 * 2.应用集群部署
 * 将应用分布到不同服务器，根据负载均衡实现高可用，关系型数据库根据主备实现高可用
 * 3.多级缓存
 * 缓存存放位置一般分为本地缓存和分布式缓存，一级缓存采用本地缓存，二级缓存为分布式缓存，还有页面缓存，片段缓存
 * 4.单点登录
 * 系统分割成多个子系统会遇到会话问题，一般采用session同步，cookies
 * 5.数据库集群，读写分离
 * 大型网站存储海量数据，为达到高性能，高可用，一般采用冗余方式进行系统设计
 * 6.消息队列
 * 消息队列可以解决子系统模块之间的耦合，
 * 用户下单后写入消息队列后直接返回客户端
 * 库存子系统读取消息队列完成库存减少
 * 配送子系统读取消息队列，进行配送
 */








