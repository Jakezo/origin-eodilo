<?
use Comento\SensAlimtalk\SensAlimtalkChannel;
use Comento\SensAlimtalk\SensAlimtalkMessage;

class AlimTalkController extends Notification
{
    use Queueable;

    private $mobiles;
    private $weblink_url;

    public function __construct($mobiles, $weblink_url)
    {
        $this->mobiles = $mobiles;
        $this->weblink_url = $weblink_url;
    }

    public function via($notifiable)
    {
        return [SensAlimtalkChannel::class];
    }

    public function toSensAlimtalk($notifiable)
    {
        return (new SensAlimtalkMessage())
            ->templateCode('inmsg')
            ->to($this->mobiles)
            ->content('조현준 회원이 2020-10-10에 입실 하였습니다.\n설문점 010-4204-0696');
            //->button(['type' => 'WL', 'name' => '지금 보러가기', 'linkMobile' => $this->weblink_url, 'linkPc' => $this->weblink_url])
            //->utmSource('utm_source=crm-kakao&utm_medium=alimtalk&utm_campaign=mentoring-adopt&utm_term=지금 보러가기&utm_content=');
    }
}

?>