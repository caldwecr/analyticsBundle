<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 4:29 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

class DynamicCSSPropertySet implements iPropertySet
{
    /**
     * @var DynamicCSSDomIdArrayCollection
     *
     * An ArrayCollection of DynamicCSSDomId objects that the dynamic css should target, this is combined with the $pseudo value to create the css selectors
     */
    protected $ids;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     *
     * The name of the pseudo class the dynamic css should target
     */
    protected $pseudo;

    /**
     * @param iTrackingTool $tool
     * @return iTrackingTool
     */
    public function pushTo(iTrackingTool $tool)
    {
       return $this->pushToDynamicCSS($tool);
    }

    /**
     * @param DynamicCSS $tool
     * @return DynamicCSS
     */
    private function pushToDynamicCSS(DynamicCSS $tool)
    {
        $tool->setDynamicCSSDomIds($this->ids);
        $tool->setPseudo($this->pseudo);
        return $tool;
    }

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     */
    public function pullFrom(iTrackingTool $tool)
    {
        return $this->pullFromDynamicCSS($tool);
    }

    /**
     * @param DynamicCSS $tool
     * @return iPropertySet
     */
    private function pullFromDynamicCSS(DynamicCSS $tool)
    {
        $this->ids = $tool->getDynamicCSSDomIds();
        $this->pseudo = $tool->getPseudo();
        return $this;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicCSSPropertySet';
    }

    /**
     * @param DynamicCSSDomIdArrayCollection $ids
     */
    public function setIds(DynamicCSSDomIdArrayCollection $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return DynamicCSSDomIdArrayCollection
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
}