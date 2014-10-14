<?php

namespace Workshop\LessonTwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BlogPost
 *
 * @ORM\Table(name="blog_posts")
 * @ORM\Entity(repositoryClass="Workshop\LessonTwoBundle\Entity\BlogPostRepository")
 */
class BlogPost
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
	 * @Assert\NotBlank(message="Bitte gib einen Titel ein!")
	 * @Assert\Length(max=255, maxMessage="Nicht mehr als {{ limit }} Zeichen!")
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/NotBlank.html
	 * @see http://symfony.com/doc/current/reference/constraints/Length.html
     */
    private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string", length=255, unique=true)
	 * @Gedmo\Slug(fields={"title"}, unique=true, updatable=false)
	 *
	 * @see https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/sluggable.md
	 */
	private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
	 * @Assert\Length(max=255, maxMessage="Nicht mehr als {{ limit }} Zeichen!")
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/Length.html
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text")
	 * @Assert\Length(
	 * 		min=10, max=1000,
	 * 		minMessage="Mindestens {{ limit }} Zeichen!", maxMessage="Nicht mehr als {{ limit }} Zeichen!"
	 * )
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/Length.html
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
	 * @Assert\Length(
	 * 		min=25, max=2000,
	 * 		minMessage="Mindestens {{ limit }} Zeichen!", maxMessage="Nicht mehr als {{ limit }} Zeichen!"
	 * )
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/Length.html
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=64)
	 * @Assert\NotBlank(message="Bitte gib einen Autor an!")
	 * @Assert\Length(max=64, maxMessage="Nicht mehr als {{ limit }} Zeichen!")
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/NotBlank.html
	 * @see http://symfony.com/doc/current/reference/constraints/Length.html
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128)
	 * @Assert\NotBlank(message="Bitte gib eine E-Mail Adresse an!")
	 * @Assert\Email(message="E-Mail nicht gültig!")
	 * @Assert\Length(max=128, maxMessage="Nicht mehr als {{ limit }} Zeichen!")
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/NotBlank.html
	 * @see http://symfony.com/doc/current/reference/constraints/Email.html
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
	 * @Gedmo\Timestampable(on="create")
	 *
	 * @see https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/timestampable.md
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
	 * @Gedmo\Timestampable(on="update")
	 *
	 * @see https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/timestampable.md
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean", nullable=true)
	 *
	 * @Assert\Choice(choices={true, false, 0, 1, null, "0", "1"}, message="Ungültiger Wert!")
	 *
	 * @see http://symfony.com/doc/current/reference/constraints/Choice.html
     */
    private $isOnline;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BlogPost
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

	/**
	 * @param string $slug
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}

	/**
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return BlogPost
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    
        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return BlogPost
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    
        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BlogPost
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return BlogPost
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return BlogPost
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return BlogPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return BlogPost
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isOnline
     *
     * @param boolean $isOnline
     * @return BlogPost
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;
    
        return $this;
    }

    /**
     * Get isOnline
     *
     * @return boolean 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }
}
