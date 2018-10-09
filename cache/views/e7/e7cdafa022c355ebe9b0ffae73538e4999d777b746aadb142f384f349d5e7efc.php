<?php

/* templates/default.twig */
class __TwigTemplate_e86257ab4dc1f576d0f591ae2148d09ea350e57f2b080e13123a32f7d28e6013 extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Document</title>
</head>
<body>
    ";
        // line 11
        echo ($context["content"] ?? null);
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "templates/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 11,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "templates/default.twig", "C:\\xampp7\\htdocs\\app\\templates\\default.twig");
    }
}
