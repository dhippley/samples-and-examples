FROM bitwalker/alpine-elixir-phoenix:latest

ADD mix.exs mix.lock ./
RUN mix do deps.get, deps.compile

ADD assets/package.json assets/
RUN cd assets && npm install

CMD ["mix", "phx.server"]