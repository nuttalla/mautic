<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\CoreBundle\Entity\FormEntity;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Page
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="Mautic\PageBundle\Entity\PageRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Page extends FormEntity
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $title;

    /**
     * @ORM\Column(name="alias", type="string")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $alias;

    /**
     * @ORM\Column(type="string")
     */
    private $template;

    /**
     * @ORM\Column(name="author", type="string", nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $author;

    /**
     * @ORM\Column(name="lang", type="string")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $language = 'en';

    /**
     * @ORM\Column(name="content", type="array")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $content = array();

    /**
     * @ORM\Column(name="publish_up", type="datetime", nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $publishUp;

    /**
     * @ORM\Column(name="publish_down", type="datetime", nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $publishDown;

    /**
     * @ORM\Column(name="hits", type="integer")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $hits = 0;

    /**
     * @ORM\Column(name="revision", type="integer")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $revision = 1;

    /**
     * @ORM\Column(name="meta_description", type="string", nullable=true, length=160)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $metaDescription;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="pages")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     **/
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="translationParent", indexBy="id", fetch="EXTRA_LAZY")
     **/
    private $translationChildren;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="translationChildren")
     * @ORM\JoinColumn(name="translation_parent_id", referencedColumnName="id")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     **/
    private $translationParent;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="variationParent", indexBy="id", fetch="EXTRA_LAZY")
     **/
    private $variationChildren;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="variationChildren")
     * @ORM\JoinColumn(name="variation_parent_id", referencedColumnName="id")
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     **/
    private $variationParent;

    /**
     * @ORM\Column(name="variation_settings", type="array", nullable=true)
     * @Serializer\Expose
     * @Serializer\Since("1.0")
     * @Serializer\Groups({"full"})
     */
    private $variationSettings = array();

    /**
     * Used to identify the page for the builder
     *
     * @var
     */
    private $sessionId;

    public function __clone() {
        $this->id = null;
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
     * Set title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->isChanged('title', $title);
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
     * Set alias
     *
     * @param string $alias
     * @return Page
     */
    public function setAlias($alias)
    {
        $this->isChanged('alias', $alias);
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Page
     */
    public function setContent($content)
    {
        $this->isChanged('content', $content);
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
     * Set publishUp
     *
     * @param \DateTime $publishUp
     * @return Page
     */
    public function setPublishUp($publishUp)
    {
        $this->isChanged('publishUp', $publishUp);
        $this->publishUp = $publishUp;

        return $this;
    }

    /**
     * Get publishUp
     *
     * @return \DateTime
     */
    public function getPublishUp()
    {
        return $this->publishUp;
    }

    /**
     * Set publishDown
     *
     * @param \DateTime $publishDown
     * @return Page
     */
    public function setPublishDown($publishDown)
    {
        $this->isChanged('publishDown', $publishDown);
        $this->publishDown = $publishDown;

        return $this;
    }

    /**
     * Get publishDown
     *
     * @return \DateTime
     */
    public function getPublishDown()
    {
        return $this->publishDown;
    }

    /**
     * Set hits
     *
     * @param \DateTime $hits
     * @return Page
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return \DateTime
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set revision
     *
     * @param integer $revision
     * @return Page
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return integer
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Page
     */
    public function setMetaDescription($metaDescription)
    {
        $this->isChanged('metaDescription', $metaDescription);
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Page
     */
    public function setLanguage($language)
    {
        $this->isChanged('language', $language);
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set category
     *
     * @param \Mautic\PageBundle\Entity\Category $category
     * @return Page
     */
    public function setCategory(\Mautic\PageBundle\Entity\Category $category = null)
    {
        $this->isChanged('category', $category);
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Mautic\PageBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Page
     */
    public function setAuthor($author)
    {
        $this->isChanged('author', $author);
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
     * Set sessionId
     *
     * @param string $id
     * @return Page
     */
    public function setSessionId($id)
    {
        $this->sessionId = $id;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return Page
     */
    public function setTemplate($template)
    {
        $this->isChanged('template', $template);
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param $prop
     * @param $val
     */
    protected function isChanged($prop, $val)
    {
        $getter  = "get" . ucfirst($prop);
        $current = $this->$getter();

        if ($prop == 'translationParent' || $prop == 'variationParent') {
            $currentId = ($current) ? $current->getId() : '';
            $newId     = $val->getId();
            if ($currentId != $newId)
                $currentTitle = ($current) ? $current->getTitle() . " ($currentId)" : '';
                $this->changes[$prop] = array($currentTitle, $val->getTitle() . " ($newId)");
        } else {
            parent::isChanged($prop, $val);
        }
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translationChildren = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variationChildren = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translationChildren
     *
     * @param \Mautic\PageBundle\Entity\Page $translationChildren
     * @return Page
     */
    public function addTranslationChild(\Mautic\PageBundle\Entity\Page $translationChildren)
    {
        $this->translationChildren[] = $translationChildren;

        return $this;
    }

    /**
     * Remove translationChildren
     *
     * @param \Mautic\PageBundle\Entity\Page $translationChildren
     */
    public function removeTranslationChild(\Mautic\PageBundle\Entity\Page $translationChildren)
    {
        $this->translationChildren->removeElement($translationChildren);
    }

    /**
     * Get translationChildren
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslationChildren()
    {
        return $this->translationChildren;
    }

    /**
     * Set translationParent
     *
     * @param \Mautic\PageBundle\Entity\Page $translationParent
     * @return Page
     */
    public function setTranslationParent(\Mautic\PageBundle\Entity\Page $translationParent = null)
    {
        $this->isChanged('translationParent', $translationParent);
        $this->translationParent = $translationParent;

        return $this;
    }

    /**
     * Get translationParent
     *
     * @return \Mautic\PageBundle\Entity\Page
     */
    public function getTranslationParent()
    {
        return $this->translationParent;
    }

    /**
     * Add variationChildren
     *
     * @param \Mautic\PageBundle\Entity\Page $variationChildren
     * @return Page
     */
    public function addVariationChild(\Mautic\PageBundle\Entity\Page $variationChildren)
    {
        $this->variationChildren[] = $variationChildren;

        return $this;
    }

    /**
     * Remove variationChildren
     *
     * @param \Mautic\PageBundle\Entity\Page $variationChildren
     */
    public function removeVariationChild(\Mautic\PageBundle\Entity\Page $variationChildren)
    {
        $this->variationChildren->removeElement($variationChildren);
    }

    /**
     * Get variationChildren
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVariationChildren()
    {
        return $this->variationChildren;
    }

    /**
     * Set variationParent
     *
     * @param \Mautic\PageBundle\Entity\Page $variationParent
     * @return Page
     */
    public function setVariationParent(\Mautic\PageBundle\Entity\Page $variationParent = null)
    {
        $this->isChanged('variationParent', $variationParent);
        $this->variationParent = $variationParent;

        return $this;
    }

    /**
     * Get variationParent
     *
     * @return \Mautic\PageBundle\Entity\Page
     */
    public function getVariationParent()
    {
        return $this->variationParent;
    }

    /**
     * Set variationSettings
     *
     * @param array $variationSettings
     * @return Page
     */
    public function setVariationSettings($variationSettings)
    {
        $this->isChanged('variationSettings', $variationSettings);
        $this->variationSettings = $variationSettings;

        return $this;
    }

    /**
     * Get variationSettings
     *
     * @return array
     */
    public function getVariationSettings()
    {
        return $this->variationSettings;
    }
}