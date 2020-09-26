<?php 

	namespace Core;

	class Request 
	{
		public $body;

		public $method;

		function __construct()
		{
			$this->method = $_SERVER['REQUEST_METHOD'];

			switch ($this->method) {
                case "DELETE":
                case "GET": $this->body = $_GET; break;
				case "POST":$this->body = $this->getPostContent(); break;
				case "PUT": $this->body = $this->getPutContent(); break;
                default: $this->body = []; break;
			}
		}

		private function getPutContent()
        {

            return ($_SERVER["CONTENT_TYPE"] == "application/json")
                ? json_decode(file_get_contents("php://input"), true)
                : parse_str(file_get_contents("php://input"), $body);
        }
		private function getPostContent(): array
        {

		    return ($_SERVER["CONTENT_TYPE"] == "application/json")
                    ? json_decode(file_get_contents("php://input"),true)
                    : $_POST;
		}
        public function __get($property){
            return array_key_exists($property, $this->body) ? $this->body[$property] : null;
        }
        public function getInstance(): Request
        {
		    return $this;
        }

        public function all(): array
        {
		    return (array) $this->body;
        }

	}