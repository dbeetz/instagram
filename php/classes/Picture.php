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
	 * location of where the Picture was taken, indicated by lat/long coordinates
	 * @var point $pictureLocation
	 **/
	private $pictureLocation;
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
	 * @param point $newPictureLocation latitude/longitude location of this Picture
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (strings are too long, negative integers, etc.)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newPictureId = null, int $newPictureUserId, string $newPictureCaption, $newPictureTimestamp = null, string $newPictureFile, point $newPictureLocation) {
		try {
				$this->setPictureId($newPictureId);
				$this->setPictureUserId($newPictureUserId);
				$this->setPictureCaption($newPictureCaption);
				$this->setPictureTimestamp($newPictureTimestamp);
				$this->setPictureFile($newPictureFile);
				$this->setPictureLocation($newPictureLocation);
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
}
