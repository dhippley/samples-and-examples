defmodule PhxDockerTemplateWeb.PageController do
  use PhxDockerTemplateWeb, :controller

  def index(conn, _params) do
    render(conn, "index.html")
  end
end
