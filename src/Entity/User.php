<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "users_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute=true
 *      )
 * )
 * @Hateoas\Relation(
 *      "modify",
 *      href = @Hateoas\Route(
 *          "users_edit",
 *          parameters = { "userId" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "users_delete",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @SWG\Property(description="The unique identifier of the user.")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(groups={"Create"})
     * @Assert\Type("string")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(groups={"Create"})
     * @Assert\Type("string")
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $creationdate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $updatedate;

    public function __construct()
    {
        $this->creationdate = new \Datetime();
        $this->updatedate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(\DateTimeInterface $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    // This method will be executed to update updatedate just before the entity is modified in the database.
    /**
     * @ORM\PreUpdate
     */
    public function updateUpdatedate()
    {
        $this->setUpdatedate(new \Datetime());
    }
}
