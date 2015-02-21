<?php

namespace TuByuem\Skrobaczka\Model;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $icq;

    /**
     * @var string
     */
    private $aimNumber;

    /**
     * @var string
     */
    private $msnNumber;

    /**
     * @var string
     */
    private $yahooNumber;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $ocupation;

    /**
     * @var string
     */
    private $hobbies;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var boolean
     */
    private $emailShown;

    /**
     * @var boolean
     */
    private $presenceHidden;

    /**
     * @var boolean
     */
    private $repliesAnnounced;

    /**
     * @var boolean
     */
    private $pmAnnounced;

    /**
     * @var boolean
     */
    private $pmWindowOpened;

    /**
     * @var boolean
     */
    private $signatureAppended;

    /**
     * @var boolean
     */
    private $bbcodeEnabled;

    /**
     * @var boolean
     */
    private $htmlEnabled;

    /**
     * @var boolean
     */
    private $emotesEnabled;

    private $boardLanguage;

    /**
     * @var string
     */
    private $timezone;

    /**
     * @var string
     */
    private $dateFormat;

    /**
     * @var boolean
     */
    private $userActive;

    /**
     * @var boolean
     */
    private $pmEnabled;

    /**
     * @var boolean
     */
    private $avatarEnabled;

    /**
     * @var boolean
     */
    private $galleryEnabled;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getIcq()
    {
        return $this->icq;
    }

    /**
     * @return string
     */
    public function getAimNumber()
    {
        return $this->aimNumber;
    }

    /**
     * @return string
     */
    public function getMsnNumber()
    {
        return $this->msnNumber;
    }

    /**
     * @return string
     */
    public function getYahooNumber()
    {
        return $this->yahooNumber;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getOcupation()
    {
        return $this->ocupation;
    }

    /**
     * @return string
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return boolean
     */
    public function isEmailShown()
    {
        return $this->emailShown;
    }

    /**
     * @return boolean
     */
    public function isPresenceHidden()
    {
        return $this->presenceHidden;
    }

    /**
     * @return boolean
     */
    public function isRepliesAnnounced()
    {
        return $this->repliesAnnounced;
    }

    /**
     * @return boolean
     */
    public function isPmAnnounced()
    {
        return $this->pmAnnounced;
    }

    /**
     * @return boolean
     */
    public function isPmWindowOpened()
    {
        return $this->pmWindowOpened;
    }

    /**
     * @return boolean
     */
    public function isSignatureAppended()
    {
        return $this->signatureAppended;
    }

    /**
     * @return boolean
     */
    public function isBbcodeEnabled()
    {
        return $this->bbcodeEnabled;
    }

    /**
     * @return boolean
     */
    public function isHtmlEnabled()
    {
        return $this->htmlEnabled;
    }

    /**
     * @return boolean
     */
    public function isEmotesEnabled()
    {
        return $this->emotesEnabled;
    }

    public function getBoardLanguage()
    {
        return $this->boardLanguage;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * @return boolean
     */
    public function isUserActive()
    {
        return $this->userActive;
    }

    /**
     * @return boolean
     */
    public function isPmEnabled()
    {
        return $this->pmEnabled;
    }

    /**
     * @return boolean
     */
    public function isAvatarEnabled()
    {
        return $this->avatarEnabled;
    }

    /**
     * @return boolean
     */
    public function isGalleryEnabled()
    {
        return $this->galleryEnabled;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $icq
     */
    public function setIcq($icq)
    {
        $this->icq = $icq;
    }

    /**
     * @param string $aimNumber
     */
    public function setAimNumber($aimNumber)
    {
        $this->aimNumber = $aimNumber;
    }

    /**
     * @param string $msnNumber
     */
    public function setMsnNumber($msnNumber)
    {
        $this->msnNumber = $msnNumber;
    }

    /**
     * @param string $yahooNumber
     */
    public function setYahooNumber($yahooNumber)
    {
        $this->yahooNumber = $yahooNumber;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param string $ocupation
     */
    public function setOcupation($ocupation)
    {
        $this->ocupation = $ocupation;
    }

    /**
     * @param string $hobbies
     */
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;
    }

    /**
     * @param string $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * @param boolean $emailShown
     */
    public function setEmailShown($emailShown)
    {
        $this->emailShown = $emailShown;
    }

    /**
     * @param boolean $presenceHidden
     */
    public function setPresenceHidden($presenceHidden)
    {
        $this->presenceHidden = $presenceHidden;
    }

    /**
     * @param boolean $repliesAnnounced
     */
    public function setRepliesAnnounced($repliesAnnounced)
    {
        $this->repliesAnnounced = $repliesAnnounced;
    }

    /**
     * @param boolean $pmAnnounced
     */
    public function setPmAnnounced($pmAnnounced)
    {
        $this->pmAnnounced = $pmAnnounced;
    }

    /**
     * @param boolean $pmWindowOpened
     */
    public function setPmWindowOpened($pmWindowOpened)
    {
        $this->pmWindowOpened = $pmWindowOpened;
    }

    /**
     * @param boolean $signatureAppended
     */
    public function setSignatureAppended($signatureAppended)
    {
        $this->signatureAppended = $signatureAppended;
    }

    /**
     * @param boolean $bbcodeEnabled
     */
    public function setBbcodeEnabled($bbcodeEnabled)
    {
        $this->bbcodeEnabled = $bbcodeEnabled;
    }

    /**
     * @param boolean $htmlEnabled
     */
    public function setHtmlEnabled($htmlEnabled)
    {
        $this->htmlEnabled = $htmlEnabled;
    }

    /**
     * @param boolean $emotesEnabled
     */
    public function setEmotesEnabled($emotesEnabled)
    {
        $this->emotesEnabled = $emotesEnabled;
    }

    public function setBoardLanguage($boardLanguage)
    {
        $this->boardLanguage = $boardLanguage;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @param string $dateFormat
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * @param boolean $userActive
     */
    public function setUserActive($userActive)
    {
        $this->userActive = $userActive;
    }

    /**
     * @param boolean $pmEnabled
     */
    public function setPmEnabled($pmEnabled)
    {
        $this->pmEnabled = $pmEnabled;
    }

    /**
     * @param boolean $avatarEnabled
     */
    public function setAvatarEnabled($avatarEnabled)
    {
        $this->avatarEnabled = $avatarEnabled;
    }

    /**
     * @param boolean $galleryEnabled
     */
    public function setGalleryEnabled($galleryEnabled)
    {
        $this->galleryEnabled = $galleryEnabled;
    }
}
