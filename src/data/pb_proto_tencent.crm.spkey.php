<?php
/**
 * Auto generated from tencent.crm.spkey.proto at 2014-12-22 19:38:19
 *
 * tencent.crm.spkey package
 */

namespace Tencent\Crm\Spkey {
/**
 * ReqBody message
 */
class ReqBody extends \ProtobufMessage
{
    /* Field index constants */
    const STR_UNAME = 1;
    const UINT64_TIME = 2;
    const STR_TOKEN = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::STR_UNAME => array(
            'name' => 'str_uname',
            'required' => false,
            'type' => 7,
        ),
        self::UINT64_TIME => array(
            'name' => 'uint64_time',
            'required' => false,
            'type' => 5,
        ),
        self::STR_TOKEN => array(
            'name' => 'str_token',
            'required' => false,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->clear();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function clear()
    {
        $this->values[self::STR_UNAME] = null;
        $this->values[self::UINT64_TIME] = null;
        $this->values[self::STR_TOKEN] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function getFields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'str_uname' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStrUname($value)
    {
        return $this->setValue(self::STR_UNAME, $value);
    }

    /**
     * Returns value of 'str_uname' property
     *
     * @return string
     */
    public function getStrUname()
    {
        return $this->getValue(self::STR_UNAME);
    }

    /**
     * Sets value of 'uint64_time' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setUint64Time($value)
    {
        return $this->setValue(self::UINT64_TIME, $value);
    }

    /**
     * Returns value of 'uint64_time' property
     *
     * @return int
     */
    public function getUint64Time()
    {
        return $this->getValue(self::UINT64_TIME);
    }

    /**
     * Sets value of 'str_token' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStrToken($value)
    {
        return $this->setValue(self::STR_TOKEN, $value);
    }

    /**
     * Returns value of 'str_token' property
     *
     * @return string
     */
    public function getStrToken()
    {
        return $this->getValue(self::STR_TOKEN);
    }
}
}

namespace Tencent\Crm\Spkey {
/**
 * RspBody message
 */
class RspBody extends \ProtobufMessage
{
    /* Field index constants */
    const UINT32_STATUS = 1;
    const STR_MSG = 2;
    const UINT32_TYPE = 3;
    const UINT32_NAME_ACCOUNT = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UINT32_STATUS => array(
            'name' => 'uint32_status',
            'required' => false,
            'type' => 5,
        ),
        self::STR_MSG => array(
            'name' => 'str_msg',
            'required' => false,
            'type' => 7,
        ),
        self::UINT32_TYPE => array(
            'name' => 'uint32_type',
            'required' => false,
            'type' => 5,
        ),
        self::UINT32_NAME_ACCOUNT => array(
            'name' => 'uint32_name_account',
            'required' => false,
            'type' => 5,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
     */
    public function __construct()
    {
        $this->clear();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function clear()
    {
        $this->values[self::UINT32_STATUS] = null;
        $this->values[self::STR_MSG] = null;
        $this->values[self::UINT32_TYPE] = null;
        $this->values[self::UINT32_NAME_ACCOUNT] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function getFields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'uint32_status' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setUint32Status($value)
    {
        return $this->setValue(self::UINT32_STATUS, $value);
    }

    /**
     * Returns value of 'uint32_status' property
     *
     * @return int
     */
    public function getUint32Status()
    {
        return $this->getValue(self::UINT32_STATUS);
    }

    /**
     * Sets value of 'str_msg' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStrMsg($value)
    {
        return $this->setValue(self::STR_MSG, $value);
    }

    /**
     * Returns value of 'str_msg' property
     *
     * @return string
     */
    public function getStrMsg()
    {
        return $this->getValue(self::STR_MSG);
    }

    /**
     * Sets value of 'uint32_type' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setUint32Type($value)
    {
        return $this->setValue(self::UINT32_TYPE, $value);
    }

    /**
     * Returns value of 'uint32_type' property
     *
     * @return int
     */
    public function getUint32Type()
    {
        return $this->getValue(self::UINT32_TYPE);
    }

    /**
     * Sets value of 'uint32_name_account' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setUint32NameAccount($value)
    {
        return $this->setValue(self::UINT32_NAME_ACCOUNT, $value);
    }

    /**
     * Returns value of 'uint32_name_account' property
     *
     * @return int
     */
    public function getUint32NameAccount()
    {
        return $this->getValue(self::UINT32_NAME_ACCOUNT);
    }
}
}
