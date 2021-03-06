<?php
$PluginInfo['vorgo'] = array(
   'Name' => 'vorgo',
   'Description' => "Just a friendly bot named Vorgo.",
   'Version' => '1.0',
   'RequiredApplications' => array('Vanilla' => '2.2'),
   'RequiredPlugins' => array('bot' => '1.0'),
   'MobileFriendly' => true,
   'Author' => "Vanilla Community",
   'AuthorUrl' => 'http://vanillaforums.org'
);

/**
 * Vorgo in an implementation of Bot.
 *
 * @see https://github.com/linc/vanilla-bot
 */
class VorgoPlugin extends Gdn_Plugin {

    /**
     * Simple call and response.
     *
     * User: Shave and a hair cut!
     * Bot: TWO BITS!
     *
     * @param Bot $bot
     */
    public function bot_shave_handler($bot) {
        if ($bot->match('shave and a hair cut')) {
            $bot->setReply($bot->mention().' TWO BITS!');
        }
    }

    /**
     * Simple call and response.
     *
     * User: Sup @vorgo?
     * Bot: Chillin'.
     *
     * @param Bot $bot
     */
    public function bot_sup_handler($bot) {
        if ($bot->match('sup @vorgo')) {
            $bot->setReply('Chillin\'.');
        }
    }

    /**
     * Simple call and response.
     *
     * User: Now we're cooking with gas!
     * Bot: KABOOM!
     *
     * @param Bot $bot
     */
    public function bot_gas_handler($bot) {
        if ($bot->match('cooking with gas')) {
            $bot->setReply('KABOOM!');
        }
    }

    /**
     * Let users send each other beers thru the bot.
     *
     * User: ^5 @Lincoln
     * Bot:  YEAH! ^5 @Lincoln
     *
     * @param Bot $bot
     */
    public function bot_fives_handler($bot) {
        if ($bot->regex('(^|[\s,\.>])\^5 @([\w-]{3,64})', $target)) { // ^5
            if (isset($target[2]) && $target[2]) {
                if (strtolower($target[2]) == 'vorgo') {
                    $bot->setReply('^5 '.$bot->mention().'!');
                } else {
                    $bot->setReply('YEAH! ^5 @'.$target[2].'.');
                }
            }
        }
    }

    /**
     * Just run structure().
     */
    public function setup() {
        $this->structure();
    }

    /**
     * Register our bot replies.
     */
    public function structure() {
        botReply('fives');
        botReply('sup');
        botReply('shave');
        botReply('gas');
    }

    /**
     * Register our bot replies.
     */
    public function onDisable() {
        botReplyDisable('fives');
        botReplyDisable('sup');
        botReplyDisable('shave');
        botReplyDisable('gas');
    }
}