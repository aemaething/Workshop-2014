<?php

namespace Workshop\LessonTwoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Workshop\LessonTwoBundle\Entity\BlogPost;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * BlogPostComment
 *
 * @ORM\Table(name="blog_post_comments")
 * @ORM\Entity(repositoryClass="Workshop\LessonTwoBundle\Entity\BlogPostCommentRepository")
 */
class BlogPostComment
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
	 * @var BlogPost
	 * @ORM\ManyToOne(targetEntity="Workshop\LessonTwoBundle\Entity\BlogPost")
	 * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false, onDelete="cascade")
	 */
	private $blogPost;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=128)
	 * @Assert\NotBlank(message="Bitte gib einen Autor an!")
	 * @Assert\Length(max=128, maxMessage="Nicht mehr als {{ limit }} Zeichen!")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128)
	 * @Assert\NotBlank(message="Bitte gib eine E-Mail Adresse an!")
	 * @Assert\Email(message="E-Mail nicht gültig!")
	 * @Assert\Length(max=128, maxMessage="Nicht mehr als {{ limit }} Zeichen!")
	 */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
	 * @Assert\Length(
	 * 		min=25, max=2000,
	 * 		minMessage="Mindestens {{ limit }} Zeichen!", maxMessage="Nicht mehr als {{ limit }} Zeichen!"
	 * )
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
	 * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
	 * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean")
     */
    private $isOnline;



	/**
	 * @param BlogPost $blogPost
	 */
	public function __construct(BlogPost $blogPost) {
		$this->setBlogPost($blogPost);
		$this->setIsOnline(true);
	}

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
     * Set author
     *
     * @param string $author
     * @return BlogPostComment
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
     * @return BlogPostComment
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
     * Set content
     *
     * @param string $content
     * @return BlogPostComment
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return BlogPostComment
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
     * @return BlogPostComment
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
     * @return BlogPostComment
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

	/**
	 * @param \Workshop\LessonTwoBundle\Entity\BlogPost $blogPost
	 */
	public function setBlogPost($blogPost)
	{
		$this->blogPost = $blogPost;
	}

	/**
	 * @return \Workshop\LessonTwoBundle\Entity\BlogPost
	 */
	public function getBlogPost()
	{
		return $this->blogPost;
	}
}
