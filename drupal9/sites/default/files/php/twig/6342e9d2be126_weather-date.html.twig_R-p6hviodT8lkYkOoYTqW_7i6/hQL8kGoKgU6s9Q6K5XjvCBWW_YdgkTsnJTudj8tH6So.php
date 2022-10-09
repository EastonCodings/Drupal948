<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/upkatiel/templates/weather-date.html.twig */
class __TwigTemplate_127432d432c28a19c126c35a2da951cf extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<h3>";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["date"] ?? null), 1, $this->source), "html", null, true);
        echo "</h3>
<table class=\"table table-hover\">
    <thead>
    <tr>
        <th>Date Time</th>
        <th>Temp C</th>
        <th>Visibility</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["collection"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["interval"]) {
            // line 13
            echo "    <tr>
        <td>";
            // line 14
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["interval"], "dateTime", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
            echo "</td>
        <td>";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["interval"], "temp", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
            echo "</td>
        <td>";
            // line 16
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["interval"], "visibility", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
            echo "</td>
        <td><img src=\"";
            // line 17
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["interval"], "weatherIconUrl", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
            echo "\"/></td>
    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['interval'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "  </tbody>
</table>
<hr>";
    }

    public function getTemplateName()
    {
        return "modules/custom/upkatiel/templates/weather-date.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 20,  73 => 17,  69 => 16,  65 => 15,  61 => 14,  58 => 13,  54 => 12,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/upkatiel/templates/weather-date.html.twig", "C:\\Xampp\\htdocs\\Drupal948\\drupal9\\modules\\custom\\upkatiel\\templates\\weather-date.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 12);
        static $filters = array("escape" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
