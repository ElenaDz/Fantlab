<?php
namespace APP\Entity;
use APP\Model\Books;
use DateTime;
use Exception;

class Book
{
    const MIN_YEAR = 1901;


    private $id;
    private $title;
    private $title_original;
    private $type;
    private $year;
    private $description;
    private $cover = null;
    public $author_name;
    private $author_birthday;


    /**
     * @param $title
     * @param $title_original
     * @param $author_name
     * @param $year
     * @param $type
     * @param $description
     * @return self
     * @throws Exception
     */
    public static function create(
        $title, $title_original, $author_name, $year, $type, $description ): Book
    {
        $book = new static();

        $book->setTitle($title);
        $book->setTitleOriginal($title_original);
        $book->setAuthorName($author_name);
        $book->setYear($year);
        $book->setType($type);
        $book->setDescription($description);

        return $book;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->author_name;
    }

    /**
     * @param mixed $author_name
     * @throws Exception
     */
    public function setAuthorName($author_name)
    {
        if (strlen($author_name) > 60) {
            throw new \Exception(
                'Заголовок книги не должен быть длинее 60 символов'
            );
        }

        $this->author_name = $author_name;
    }

    private function __construct() {}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

	// fixme у нас id формируется автоматически в БД, его нельзя изменить значит такого метода не должно быть
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

	// fixme во всех сетерах, чтобы не делать лишней работы, нужно делать проверку, что новое значение отличается
	//  от старого и только тогда что-то делать
    /**
     * @throws Exception
     */
    public function setTitle($title)
    {
		// fixme так как мы работаем с русскими буквами в utf8 кодировке нам нужно пользоваться функциями
		//  работы со строками с приставкой mb_ например mb_strlen Исправь везде
        if (strlen($title) > 150) {
            throw new \Exception(
                'Заголовок книги не должен быть длиннее 150 символов'
            );
        }

        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitleOriginal()
    {
        return $this->title_original;
    }

    /**
     * @param mixed $title_original
     * @throws Exception
     */
    public function setTitleOriginal($title_original)
    {
		// fixme почему то не удается сохранить название "0123456789 0123456789 0123456789 0123456789 0123456789"
        if (strlen($title_original) > 150) {
            throw new \Exception(
                'Заголовок книги не должен быть длиннее 150 символов'
            );
        }

        $this->title_original = $title_original;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @throws Exception
     */
    public function setType($type)
    {
        if ( ! TypeBook::isValidType($type)) {
            throw new \Exception(
				// fixme "в списке книг"?
                // fixme а где пробелы внутри скобок
                'Жанр "'.$type.'" не найден в списке книг: '.implode(',', TypeBook::getAll())
            );
        }

		// todo поменяй тип столбца с varchar на enum в БД для type
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @throws Exception
     */
    public function setYear($year)
    {
        if ($year < self::MIN_YEAR or $year > date('Y')) {
            throw new \Exception(
                'Год должен быть в пределах от '.self::MIN_YEAR.' до текущего'
            );
        }

        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

	// fixme что то у тебя в этом классе много слов "mixed" хотя я его вообще не использую, замени на что то имеющие смысл
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover_url
     * @throws Exception
     */
    public function setCoverUrl($cover_url)
    {
        if (empty($cover_url)) {
            $this->cover = null;

        } else {
			// fixme это точно все еще нужно Может быть удалить?
            if (empty($this->getId())) {
                throw new \Exception(
                    'Нельзя добавить обложку, пока книга не добавлена в базу данных. Потому что нет id.'
                );
            }

            $extension = pathinfo($cover_url, \PATHINFO_EXTENSION);

            $extension = empty($extension) ? 'jpg' : $extension;

            $content = @file_get_contents($cover_url);
            if ($content === false) {
                throw new \Exception(
                    'Не удалось скачать '.$cover_url
                );
            }

            $file_name = $this->getId().'.'.$extension;

            $file_path = __DIR__.'/../../assets/imgs/covers/'.$file_name;

            $return = file_put_contents($file_path, $content);

            if ($return === false) {
                throw new \Exception(
                    'Не удалось сохранить файл '.$file_path
                );
            }

            $this->cover = $file_name;
        }
    }

    /**
     * @throws Exception
     */
	public function save()
    {
        if ($this->getId()) {
            Books::save($this);

        } else {
            $this->id = Books::add($this);
        }

        return $this->getId();
    }

    public function getCoverPath()
    {
		if (empty($this->getCover())) return null;

        return __DIR__.'/../../assets/imgs/covers/'.$this->getCover();
    }

    /**
     * @throws Exception
     */
    public function getAuthorAge(): string
    {
        $origin = DateTime::createFromFormat('Y', $this->year);
        $target = new DateTime($this->author_birthday);

        $interval = $origin->diff($target);
        $age = $interval->format('%Y');

        return $age.' '.self::number($age);
    }

    // https://ru.stackoverflow.com/questions/89458/%D0%A4%D1%83%D0%BD%D0%BA%D1%86%D0%B8%D1%8F-%D0%B4%D0%BB%D1%8F-%D0%BE%D0%BF%D1%80%D0%B5%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F-%D0%BE%D0%BA%D0%BE%D0%BD%D1%87%D0%B0%D0%BD%D0%B8%D1%8F-%D1%81%D0%BB%D0%BE%D0%B2%D0%B0-%D0%BF%D0%BE-%D1%87%D0%B8%D1%81%D0%BB%D0%B8%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D0%BC%D1%83-1-%D0%B3%D0%BE%D0%B4-2-%D0%B3%D0%BE%D0%B4%D0%B0-5-%D0%BB%D0%B5%D1%82
    private function number($n): string
    {
        $titles = array('год', 'года', 'лет');
        $cases = array(2, 0, 1, 1, 1, 2);
        return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
    }
}