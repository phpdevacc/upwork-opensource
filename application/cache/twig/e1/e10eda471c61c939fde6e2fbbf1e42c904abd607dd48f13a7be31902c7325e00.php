<?php

/* webview/jobs/twig/contract.twig */
class __TwigTemplate_0e3ffd94f0d78bb3b0fba7b33a695e079c4f7e74868d1817d610c6a54cd2aa42 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/twig/contract.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'styles' => array($this, 'block_styles'),
            'content' => array($this, 'block_content'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "webview/layout/twig/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        if (twig_test_empty($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array()))) {
            // line 4
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array());
        } else {
            // line 6
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array());
        }
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "  ";
        echo twig_escape_filter($this->env, (isset($context["job_title"]) ? $context["job_title"] : null), "html", null, true);
        echo " - Winjob  ";
    }

    // line 11
    public function block_styles($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayParentBlock("styles", $context, $blocks);
        echo "
    
    <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, base_url("assets/css/pages/job-common.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, base_url("assets/css/pages/contract.css"), "html", null, true);
        echo "\">
";
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
        // line 19
        echo "    
    ";
        // line 20
        $context["job_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()));
        // line 21
        echo "    ";
        $context["fuser_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()));
        // line 22
        echo "    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">";
        // line 29
        echo twig_escape_filter($this->env, sprintf(app_lang("text_job_since"), app_date($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "start_date", array()), " M j, Y ")), "html", null, true);
        echo "</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "contact_id", array()), "html", null, true);
        echo " </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-5\">
                            <div class=\"row\">
                                <div style=\"margin-left: 20px;\" class=\"col-md-4 col-md-offset-1 text-left\">
                                    <div class=\"st_img hourly_client_view_st_img\">
                                        <img src=\"";
        // line 42
        echo twig_escape_filter($this->env, app_user_img($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "cropped_image", array())), "html", null, true);
        echo "\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <h5 style=\"margin-top: -4px;\" class=\"free_name\">";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "html", null, true);
        echo "</label>
                                        <br> <p class=\"\"><strong>";
        // line 47
        echo twig_escape_filter($this->env, app_substr($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "tagline", array()), twig_constant("CONTRACT_JOB_COMPANY_NAME_MAX"), "..."), "html", null, true);
        echo "</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                ";
        // line 53
        if (($this->getAttribute((isset($context["webuser"]) ? $context["webuser"] : null), "isactive", array()) == 0)) {
            // line 54
            echo "                                    <label style=\"margin-top: -8px;\" class=\"gray-text\">
                                        ";
            // line 55
            $context["hold"] = "<span style='color:#ff0000;'>%s</span>";
            // line 56
            echo "                                        ";
            echo sprintf(sprintf(app_lang("text_job_status_state"), (isset($context["hold"]) ? $context["hold"] : null)), app_lang("text_job_state_hold"));
            echo "
                                    </label>
                                ";
        } elseif (($this->getAttribute(        // line 58
(isset($context["job_status"]) ? $context["job_status"] : null), "jobstatus", array()) == 1)) {
            // line 59
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_ended")), "html", null, true);
            echo "</label>
                                ";
        } else {
            // line 61
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_actived")), "html", null, true);
            echo "</label>
                                ";
        }
        // line 63
        echo "                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button _job_btn_message\" 
                                       value=\"";
        // line 68
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\" 
                                       data-bid=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_id", array()), "html", null, true);
        echo "\"
                                       data-uid=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()), "html", null, true);
        echo "\"
                                       data-jid=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()), "html", null, true);
        echo "\" 
                                       />
                            </div>
                        </div>
                        
                        <div class=\"col-md-12\">
                            <div class=\"job_title client_job_title\">
                                <span class=\"clint_view_j-title\">
                                    ";
        // line 79
        echo twig_escape_filter($this->env, app_substr((isset($context["job_title"]) ? $context["job_title"] : null), twig_constant("CONTRACT_JOB_TITLE_MAX"), "..."), "html", null, true);
        echo "</span><br />
                                <a href=\"";
        // line 80
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "jobs/view/";
        echo twig_escape_filter($this->env, url_title($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array())), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_job_original_view"), "html", null, true);
        echo "</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class=\"bg-change\"></div>
            
            ";
        // line 89
        if (($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_type", array()) == twig_constant("FIXED_JOB_TYPE"))) {
            // line 90
            echo "                ";
            echo twig_include($this->env, $context, "webview/jobs/partials/job-nav-fixed-infos.twig");
            echo "
            ";
        } else {
            // line 92
            echo "                ";
            echo twig_include($this->env, $context, "webview/jobs/partials/job-nav-hourly-infos.twig");
            echo "
            ";
        }
        // line 94
        echo "            
        </div>
    </section>
    
    ";
        // line 98
        echo twig_include($this->env, $context, "webview/modals/message-conversion-modal.twig", array("webuser_fname" => $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "webuser_lname" => $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "job_title" => (isset($context["job_title"]) ? $context["job_title"] : null)));
        echo "
        
    ";
        // line 100
        echo twig_include($this->env, $context, "webview/modals/milestone-modal.twig");
        echo "

    ";
        // line 102
        echo twig_include($this->env, $context, "webview/modals/payment-modal.twig");
        echo "
    
";
    }

    // line 106
    public function block_js($context, array $blocks = array())
    {
        // line 107
        echo "    
    ";
        // line 109
        echo "    <script> var page = 'contract'; </script>
    
    <script data-main=\"";
        // line 111
        echo twig_escape_filter($this->env, app_modular_js("winjob"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.dev.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 112
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/modernizr-2.8.3.min.js"), "html", null, true);
        echo "\"></script>
    
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/twig/contract.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  260 => 112,  254 => 111,  250 => 109,  247 => 107,  244 => 106,  237 => 102,  232 => 100,  227 => 98,  221 => 94,  215 => 92,  209 => 90,  207 => 89,  189 => 80,  185 => 79,  174 => 71,  170 => 70,  166 => 69,  162 => 68,  155 => 63,  149 => 61,  143 => 59,  141 => 58,  135 => 56,  133 => 55,  130 => 54,  128 => 53,  119 => 47,  113 => 46,  106 => 42,  93 => 32,  87 => 29,  78 => 22,  75 => 21,  73 => 20,  70 => 19,  67 => 18,  61 => 15,  57 => 14,  51 => 12,  48 => 11,  40 => 9,  36 => 1,  33 => 6,  30 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"webview/layout/twig/layout.twig\" %}

{% if job_status.hire_title is empty %}
    {% set job_title = job_status.title %}
{% else %}
    {% set job_title = job_status.hire_title %}
{% endif  %}
                                    
{% block title %}  {{ job_title }} - Winjob  {% endblock %}

{% block styles %}
    {{ parent() }}
    
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/job-common.css\") }}\">
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/contract.css\") }}\">
{% endblock %}

{% block content %}
    
    {% set job_id_encoded   = base64_encode( job_status.job_id ) %}
    {% set fuser_id_encoded = base64_encode( job_status.fuser_id ) %}
    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">{{ app_lang('text_job_since')|format( app_date( job_status.start_date, ' M j, Y ') ) }}</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID {{ job_status.contact_id }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-5\">
                            <div class=\"row\">
                                <div style=\"margin-left: 20px;\" class=\"col-md-4 col-md-offset-1 text-left\">
                                    <div class=\"st_img hourly_client_view_st_img\">
                                        <img src=\"{{ app_user_img( job_status.cropped_image ) }}\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <h5 style=\"margin-top: -4px;\" class=\"free_name\">{{ job_status.webuser_fname }} {{ job_status.webuser_lname }}</label>
                                        <br> <p class=\"\"><strong>{{ app_substr(job_status.tagline, constant('CONTRACT_JOB_COMPANY_NAME_MAX'), '...') }}</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                {% if webuser.isactive == 0 %}
                                    <label style=\"margin-top: -8px;\" class=\"gray-text\">
                                        {% set hold = \"<span style='color:#ff0000;'>%s</span>\" %}
                                        {{ app_lang('text_job_status_state')|format(hold)|format(app_lang('text_job_state_hold'))|raw }}
                                    </label>
                                {% elseif job_status.jobstatus == 1 %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_ended')) }}</label>
                                {% else %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_actived')) }}</label>
                                {% endif %}
                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button _job_btn_message\" 
                                       value=\"{{ app_lang('text_job_btn_message') }}\" 
                                       data-bid=\"{{ job_status.bid_id }}\"
                                       data-uid=\"{{ job_status.fuser_id }}\"
                                       data-jid=\"{{ job_status.job_id }}\" 
                                       />
                            </div>
                        </div>
                        
                        <div class=\"col-md-12\">
                            <div class=\"job_title client_job_title\">
                                <span class=\"clint_view_j-title\">
                                    {{ app_substr(job_title, constant('CONTRACT_JOB_TITLE_MAX'), '...') }}</span><br />
                                <a href=\"{{ base_url() }}jobs/view/{{ url_title( job_status.title ) }}/{{ job_id_encoded }}\">{{ app_lang('text_job_original_view') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class=\"bg-change\"></div>
            
            {% if job_status.job_type == constant('FIXED_JOB_TYPE') %}
                {{ include('webview/jobs/partials/job-nav-fixed-infos.twig') }}
            {% else %}
                {{ include('webview/jobs/partials/job-nav-hourly-infos.twig') }}
            {% endif %}
            
        </div>
    </section>
    
    {{ include('webview/modals/message-conversion-modal.twig', {'webuser_fname': job_status.webuser_fname, 'webuser_lname': job_status.webuser_lname , 'job_title': job_title }) }}
        
    {{ include(\"webview/modals/milestone-modal.twig\") }}

    {{ include(\"webview/modals/payment-modal.twig\") }}
    
{% endblock %}

{% block js %}
    
    {# this variable defines the asset/modular/pages file to load #}
    <script> var page = 'contract'; </script>
    
    <script data-main=\"{{ app_modular_js(\"winjob\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script>
    <script src=\"{{ site_url(\"assets/js/vendor/modernizr-2.8.3.min.js\") }}\"></script>
    
{% endblock %}
", "webview/jobs/twig/contract.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\contract.twig");
    }
}
