<?php

/* views/main.twig */
class __TwigTemplate_1fe5aecf620c340cda4a035c48cd7fc1622d97d25f7f4d70dae13901857fe349 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>";
        echo twig_escape_filter($this->env, ($context["header"] ?? null), "html", null, true);
        echo "</h1>
";
        // line 2
        echo twig_escape_filter($this->env, ($context["text"] ?? null), "html", null, true);
        echo "
h
";
    }

    public function getTemplateName()
    {
        return "views/main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "views/main.twig", "C:\\xampp7\\htdocs\\app\\views\\main.twig");
    }
}
