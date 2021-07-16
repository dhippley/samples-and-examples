defmodule PhxDockerTemplate.Repo do
  use Ecto.Repo,
    otp_app: :phx_docker_template,
    adapter: Ecto.Adapters.Postgres
end
