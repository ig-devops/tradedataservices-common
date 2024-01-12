<?php

namespace TradeDataServices\Common\Interfaces;

interface EventListener
{


    public static function eventsSubscribedTo();


    public function notify(Event $event);
}
