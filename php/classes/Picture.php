<?php
namespace Edu\Cnm\dbeets\InstagramDataDesign;

require_once("autoload.php");

/**
 * Example class modeled after the picture entity of Instagram
 *
 * This should successfully model some of the state variables that Instagram uses for it's picture posting processes.
 *
 * @author Devon Beets <dbeetzz@gmail.com>
 * @version 3.0.0
 **/
class Picture implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Picture; this is the primary key
	 * @var int $pictureId
	 **/
	private $pictureId;
	/**
	 * id for the user who posted the Picture; this is a foreign key
	 * @var int $pictureUserId
	 **/
	private $pictureUserId;
	/**
	 * caption provided by the user who posted the Picture
	 * @var string $pictureCaption
	 **/
	private $pictureCaption;
	/**
	 * file of the Picture posted
	 * @var string $pictureFile
	 **/
	private $pictureFile;
	/**
	 * time and date the Picture was taken, in a PHP DateTime object
	 * @var \DateTime $pictureTimestamp
	 **/
	private $pictureTimestamp;

	/**
	 * constructor for this Picture
	 *
	 * @param int|null $newPictureId id of this Picture or null if a new Picture
	 * @param int $newPictureUserId id of the User that posted this Picture
	 * @param string $newPictureCaption string content containing the caption data the User posted with a new Picture
	 * @param \DateTime|string|null $newPictureTimestamp date and time Picture was posted or null if set to current date and time
	 * @param string $newPictureFile data containing the Picture
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (strings are too long, negative integers, etc.)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newPictureId = null, int $newPictureUserId, string $newPictureCaption, $newPictureTimestamp = null, string $newPictureFile) {
		try {
				$this->setPictureId($newPictureId);
				$this->setPictureUserId($newPictureUserId);
				$this->setPictureCaption($newPictureCaption);
				$this->setPictureTimestamp($newPictureTimestamp);
				$this->setPictureFile($newPictureFile);
		} catch(\InvalidArgumentException $invalidArgument) {
				//rethrow the exception to the caller
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0,$invalidArgument));
		} catch(\RangeException $range) {
				//rethrow the exception to the caller
				throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
				//rethrow the exception to the caller
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
				//rethrow the exception to the caller
				throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for picture id
	 *
	 * @return int|null value of picture id
	 **/
	public function getPictureId() {
			return($this->pictureId);
	}
	/**
	 * mutator function for picture id
	 *
	 * @param int|null $newPictureId value of new picture id
	 * @throws \RangeException if $newPictureId is not positive
	 * @throws \TypeError if $newPictureId is not an integer
	 **/
	public function setPictureId(int $newPictureId = null) {
			//if the picture id is null, this is a new picture without a mySQL assigned id (yet)
			if($newPictureId === null) {
					$this->pictureId = null;
					return;
			}

			//verify that the picture id is positive
			if ($newPictureId <= 0) {
					throw(new \RangeException("picture id is not positive"));
			}

			//convert and store the picture id
			$this->pictureId = $newPictureId;
	}
	/**
	 * accessor method for picture user id
	 *
	 * @return int|null $newPictureUserId value of new user picture id
	 **/
	public function getPictureUserId() {
		return($this->pictureUserId);
	}
	/**
	 * mutator method for picture user id
	 *
	 * @param int|null $newPictureUserId value of new picture user id
	 * @throws \RangeException if new picture user id is not positive
	 * @throws \TypeError if new picture user id is not an integer
	 **/
	public function setPictureUserId(int $newPictureUserId = null) {
		//if the picture user id is null, this is a new picture user id without a mySQL assigned id (yet)
		if($newPictureUserId === null) {
			$this->pictureUserId = null;
			return;
		}

		//verify that the picture user id is positive
		if($newPictureUserId <= 0) {
				throw(new \RangeException("picture user id is not positive"));
		}

		//convert and store the picture user id
		$this->pictureUserId = $newPictureUserId;
	}
	/**
	 * accessor method for picture caption content
	 *
	 * @return string value of picture caption content
	 **/
	public function getPictureCaption() {
		return($this->pictureCaption);
	}
	/**
	 * mutator method for picture caption content
	 *
	 * @param string $newPictureCaption new value of picture caption content
	 * @throws \InvalidArgumentException if $newPictureCaption is not a string or insecure
	 * @throws \RangeException if $newPictureCaption is > 100 characters
	 * @throws \TypeError if $newPictureCaption is not a string
	 **/
	public function setPictureCaption(string $newPictureCaption) {
		//verify the picture content is secure
		$newPictureCaption = trim($newPictureCaption);
		$newPictureCaption = filter_var($newPictureCaption, FILTER_SANITIZE_STRING);
		if(empty($newPictureCaption) === true) {
				throw (new \InvalidArgumentException("picture caption content is empty or insecure"));
		}

		//verify the picture caption content will fit in the database
		if(strlen($newPictureCaption) > 100) {
				throw (new \RangeException("picture caption content is too large"));
		}

		//store the picture caption content
		$this->pictureCaption = $newPictureCaption;
	}
	/**
	 * accessor method for picture timestamp
	 *
	 * @return \DateTime value for picture timestamp
	 **/
	public function getPictureTimestamp() {
		return($this->pictureTimestamp);
	}
	/**
	 * mutator method for picture timestamp
	 *
	 * @param \DateTime|string|null $newPictureTimestamp picture timestamp as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPictureTimestamp is not a valid object or a string
	 * @throws \RangeException if $newPictureTimestamp is a date that does not exist
	 **/
	public function setPictureTimestamp($newPictureTimestamp = null) {
		//base case: if the date is null, use the current date and time
		if($newPictureTimestamp === null) {
			$this->pictureTimestamp = new \DateTime();
			return;
		}

		//store the picture date
		try {
				$newPictureTimestamp = self::validateDateTime($newPictureTimestamp);
		} catch(\InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
				throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->pictureTimestamp = $newPictureTimestamp;
	}
}
