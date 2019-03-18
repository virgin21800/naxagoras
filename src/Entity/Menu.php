<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $route;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="enfants")
     */
    private $parent;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Menu", mappedBy="parent")
     */
    private $enfants;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="menu")
     */
    private $pages;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }
    public function getRoute(): ?string
    {
        return $this->route;
    }
    public function setRoute(string $route): self
    {
        $this->route = $route;
        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
    public function getParent(): ?self
    {
        return $this->parent;
    }
    public function setParent(?self $parent): self
    {
        $this->parent = $parent;
        return $this;
    }
    /**
     * @return Collection|self[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }
    public function addEnfant(self $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }
        return $this;
    }
    public function removeEnfant(self $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            // set the owning side to null (unless already changed)
            if ($enfant->getParent() === $this) {
                $enfant->setParent(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }
    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setMenu($this);
        }
        return $this;
    }
    public function removePage(Page $page): self
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getMenu() === $this) {
                $page->setMenu(null);
            }
        }
        return $this;
    }


}